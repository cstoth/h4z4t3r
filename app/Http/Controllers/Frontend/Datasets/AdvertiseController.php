<?php

namespace App\Http\Controllers\Frontend\Datasets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Datasets\Advertise\AdvertiseManageRequest;
use App\Http\Requests\Backend\Datasets\Advertise\AdvertiseUpdateRequest;
use App\Models\Advertise;
use App\Models\Car;
use App\Repositories\Backend\Datasets\AdvertiseRepository;
use App\Models\Passanger;
use App\Helpers\Hazater;
use App\Models\Midpoint;
use App\Mail\Frontend\SendUpdate;
use App\Models\Reserve;
use App\Mail\Frontend\SendMeUpdate;
use App\Models\Date;
use App\Models\Hunter;
use App\Console\Commands\HunterCheck;
use App\Models\City;
use App\Models\Rate;

use App\Mail\Frontend\SendCancel;
use App\Mail\Frontend\SendMeCancel;
use App\Mail\Frontend\SendDelete;
use App\Mail\Frontend\SendMeDelete;
use App\Models\Auth\User;
use App\Mail\Frontend\SendMeRevoke;

/**
 * Class AdvertiseController.
 */
class AdvertiseController extends Controller {
    /**
     * @var AdvertiseRepository
     */
    protected $repository;

    /**
     * @param AdvertiseRepository       $repository
     */
    public function __construct(AdvertiseRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param AdvertiseManageRequest $request
     *
     * @return mixed
     */
    public function index(AdvertiseManageRequest $request) {
        return view('frontend.datasets.advertise.index')
            ->withAdvertise($this->repository
                ->orderBy('id', 'asc')
                ->paginate(10)
        );
    }

    /**
     * @param AdvertiseManageRequest $request
     *
     * @return mixed
     */
    public function create(AdvertiseManageRequest $request) {
        return $this->gotoTab(1);
    }

    /**
     * @param AdvertiseManageRequest $request
     * @param Advertise             $advertise
     *
     * @return mixed
     */
    public function show(AdvertiseManageRequest $request, Advertise $advertise) {
        $advertise->save();
        $passangers = Reserve::where('advertise_id', $advertise->id)->orderBy('id')->get();
        $midpoints = Midpoint::where('advertise_id', $advertise->id)->orderBy('order')->get();
        $dates = Date::where('advertise_id', $advertise->id)->orderBy('date')->get();
        $regular_options = $advertise->regular == null ? "unique" : "regular";

        return view('frontend.datasets.advertise.show')->with([
            'advertise' => $advertise,
            'passangers' => $passangers,
            'midpoints' => $midpoints,
            'dates' => $dates,
            'regular_options' => $regular_options,
        ]);
    }

    /**
     * @param AdvertiseManageRequest $request
     * @param Advertise             $advertise
     *
     * @return mixed
     */
    public function edit(AdvertiseManageRequest $request, Advertise $advertise) {
        if (!Auth::user()) return redirect()->route('frontend.auth.login')->withFlashInfo('A munkamenete lejárt, jelentkezzen be ismét!');

        if (!$advertise->isEditable()) {
            return $this->show($request, $advertise)->withFlashInfo('A hirdetés nem törölhető!');
        }

        $advertises = Advertise::whereRaw('user_id='.Auth::id().' AND template IS NULL');
        $passangers = Passanger::whereRaw('advertise_id IN (SELECT id FROM advertises WHERE user_id='.Auth::id().')');
        $templates = Advertise::whereRaw('user_id='.Auth::id().' AND template IS NOT NULL');
        $midpoints = Midpoint::where('advertise_id', $advertise->id)->orderBy('order');
        $hunters = Hunter::where('user_id', Auth::id());
        $dates = Date::where('advertise_id', $advertise->id)->orderBy('date');
        $regular_options = $advertise->regular == null ? "unique" : "regular";

        return view('frontend.datasets.advertise.edit')->with([
            'tab' => 1,
            'advertise' => $advertise,
            'cars' => Auth::user()->cars()->get(),
            'advertises' => $advertises->get(),
            'passangers' => $passangers->get(),
            'templates' => $templates->get(),
            'midpoints' => $midpoints->get(),
            'hunter' => new Hunter(),
            'hunters' => $hunters->get(),
            'dates' => $dates->get(),
            'regular_options' => $regular_options,
        ]);
    }

    private function copyMidPoints(Advertise $from, Advertise $to) {
        $midpoints = Midpoint::where('advertise_id', $from->id)->get();
        foreach ($midpoints as $midpoint) {
            $mp = $midpoint->replicate();
            $mp->advertise_id = $to->id;
            $mp->save();
        }
    }

    /**
     * @param AdvertiseManageRequest $request
     * @param Advertise             $advertise
     *
     * @return mixed
     */
    public function copy(AdvertiseManageRequest $request, Advertise $advertise) {
        //dd($request);
        $copied = $advertise->replicate();
        $copied->start_date = null;
        $copied->end_date = null;
        $copied->status = Advertise::ACTIVE;
        $copied->save();
        $this->copyMidPoints($advertise, $copied);
        //return $this->edit($request, $copied);
        return $this->show($request, $copied);
    }

    /**
     *
     */
    public function isCarFree($id, $car_id, $start_date, $end_date) {
        $cnt = Advertise::where(function($query) use($start_date, $end_date) {
            $query->whereBetween('start_date', [$start_date, $end_date]);
            $query->orWhereBetween('end_date', [$start_date, $end_date]);
        });
        $cnt->whereIn('status', [Advertise::ACTIVE, Advertise::PROGRESS])
            ->where('car_id', $car_id)
            ->whereNotIn('id', [$id]);
        //dd(Hazater::getQueries($cnt));
        $cnt = $cnt->count();
        return $cnt == 0;
    }

    /**
     * @param AdvertiseUpdateRequest $request
     * @param Advertise             $advertise
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(AdvertiseUpdateRequest $request, Advertise $advertise) {
        //dd($request);
        $start_date = Input::get('start_date');
        $end_date = Input::get('end_date');
        if ($start_date >= $end_date) {
            return redirect()->route('frontend.datasets.advertise.edit', $advertise)->withFlashDanger(__("alerts.backend.advertise.dates-error"));
        }

        $car_id = Input::get('car_id');
        if (!$this->isCarFree($advertise->id, $car_id, $start_date, $end_date)) {
            //return $this->redirTab(1)->withFlashDanger(__("alerts.backend.advertise.carnotfree-error"));
            return $this->redirTab(1)->withFlashDanger("A kiválasztott gépjármű az adott időpontban másik úton lesz!");
        }

        if (($request['publish_options'] == 'unique') && ($request['dates'] == null)) {
            return redirect()->route('frontend.datasets.advertise.edit', $advertise)->withFlashDanger("Egyedi gyakoriságú útnál meg kell adni legalább egy dátumot!");
        }

        $cnt1 = $advertise->reserve_count + $request['free_seats'];
        $cnt2 = $advertise->car->seats;
        if ($cnt1 > $cnt2) {
            return redirect()->route('frontend.datasets.advertise.edit', $advertise)->withFlashDanger("A szabad ülések száma nem megfelelő!");
        }

        $this->repository->update($advertise, $request->only(
            'user_id',
            'car_id',
            'template',
            'regular',
            'start_city_id',
            'end_city_id',
            'start_date',
            'end_date',
            'free_seats',
            //'retour',
            'description',
            'midpoints',
            'midpointdates',
            'price',
            'hours',
            'status',
            'highway',
            'publish_options',
            'dates'
        ));

        \Log::info('A hirdetés ('.$advertise->id.') módosult ' . Hazater::routeLabel($advertise->id));
        if (!Hazater::isLocal()) {
            Mail::send(new SendMeUpdate($advertise->user, $advertise));
            $reserves = Reserve::where('advertise_id', $advertise->id)->get();
            foreach ($reserves as $reserve) {
                Mail::send(new SendUpdate($reserve->user, $advertise));
            }
            HunterCheck::checkAdvertise($advertise); //A módosult hirdetés megfelel egy hirdetés vadásznak?
        }
        return redirect()->route('frontend.user.driver.menu')->withFlashSuccess(__('alerts.backend.advertise.updated'));
    }

    /**
     *
     */
    public function updateUserRate($user_id) {
        $rate = Rate::where('user_id', $user_id)->avg('rate');
        $user = User::find($user_id);
        $user->rate = $rate;
        $user->save();
    }

    /**
     *
     */
    public function storeRate($user_id, $advertise_id, $rate, $comment) {
        $model = new Rate();
        $model->user_id = $user_id;
        $model->advertise_id = $advertise_id;
        $model->rate = intval($rate);
        $model->comment = $comment;
        $model->save();

        $this->updateUserRate($user_id);
    }

    /**
     *
     */
    public function close(AdvertiseManageRequest $request, Advertise $advertise) {
        $prefix = "rating-";
        //dd($request->request);

        // TODO értékelés
        foreach ($request->request->keys() as $key) {
            if (substr($key, 0, strlen($prefix)) == $prefix) {
                $value = $request[$key];
                $uid = ltrim($key, $prefix);
                $comment = $request["comment-" . $uid];
                $this->storeRate($uid, $advertise->id, $value, $comment);
            }
        }

        $advertise->status = Advertise::CLOSED;
        $advertise->save();

        //return $this->redirTab(2)->withFlashSuccess(__("alerts.backend.advertise.closed"));
        return redirect()->route('frontend.user.passanger.menu')->withFlashSuccess(__("alerts.backend.advertise.closed"));
    }

    /**
     *
     */
    public function rate(Advertise $advertise) {
        if (!Auth::user()) return redirect()->route('frontend.auth.login')->withFlashInfo('A munkamenete lejárt, jelentkezzen be ismét!');
        return view('frontend.datasets.advertise.rate')->withAdvertise($advertise);
    }

    /**
     * @param AdvertiseManageRequest $request
     * @param Advertise             $advertise
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(AdvertiseManageRequest $request, Advertise $advertise) {
        if ($advertise->isDeletable()) {
            //dd($request);
            $this->repository->deleteById($advertise->id);
        }
        // TODO event(new AdvertiseDeleted($advertise));

        return redirect()->route('frontend.datasets.advertise.index')->withFlashSuccess(__('alerts.backend.advertise.deleted'));
    }

    /**
     *
     */
    public function getDriverMenuData($tab, $advertise = null) {
        //dd($advertise);

        if ($tab == "#submit-ad") {
            $tab = 1;
        } else if ($tab == "#advertises") {
            $tab = 2;
        } else if ($tab == "#passangers") {
            $tab = 3;
        } else if ($tab == "#cars") {
            $tab = 4;
        }

        if (!$advertise) {
            $advertise = new Advertise;
            $advertise->regular = 0;
        }
        $advertise->user_id = Auth::id();
        //$advertises = Advertise::whereRaw('user_id=' . Auth::id() . ' AND template IS NULL')->orderBy('start_date');
        $advertises = Advertise::whereRaw('user_id=' . Auth::id() . ' AND template IS NULL')->orderBy('status');
        $passangers = Reserve::join('advertises', 'advertise_id', '=', 'advertises.id')
            ->where('advertises.user_id', '=', Auth::id())
            //->select('reserves.*', 'advertises.start_date')->orderBy('advertises.start_date');
            ->select('reserves.*', 'advertises.start_date')->orderBy('advertises.status');
        $templates = Advertise::whereRaw('user_id=' . Auth::id() . ' AND template IS NOT NULL');
        $midpoints = Midpoint::where('advertise_id', $advertise->id)->orderBy('order');
        $hunters = Hunter::where('user_id', Auth::id());
        $dates = Date::where('advertise_id', $advertise->id)->orderBy('date');
        $regular_options = $advertise->regular == null ? "unique" : "regular";
        $cars = Auth::user()->cars();

        return [
            'tab'               => $tab,
            'user'              => Auth::user(),
            'advertise'         => $advertise,
            'cars'              => $cars->get(),
            'advertises'        => $advertises->get(),
            'passangers'        => $passangers->get(),
            'templates'         => $templates->get(),
            'midpoints'         => $midpoints->get(),
            'hunter'            => new Hunter(),
            'hunters'           => $hunters->get(),
            'dates'             => $dates->get(),
            'regular_options'   => $regular_options,
        ];
    }

    /**
     *
     */
    public function gotoTab($tab, $advertise = null) {
        $drivermenudata = $this->getDriverMenuData($tab, $advertise);
        return view('frontend.user.driver')->with($drivermenudata);
    }

    /**
     *
     */
    public function redirTab($tab, $advertise = null) {
        $drivermenudata = $this->getDriverMenuData($tab, $advertise);
        return redirect()->route('frontend.user.driver.menu')->with($drivermenudata);
    }

    /**
     *
     */
    public function driverMenu(Request $request) {
        session_start();
        $tab = 2;

        if (isset($_SESSION["DRIVER_TAB"])) {
            $tab = $_SESSION["DRIVER_TAB"];
        }
        //dd($_SESSION["DRIVER_TAB"]);
        return $this->gotoTab($tab);
    }

    /**
     *
     */
    public function driverCars(Request $request) {
        return $this->gotoTab(4);
    }

    /**
     *
     */
    function list() {
        return $this->gotoTab(2);
    }

    /**
     *
     */
    protected function saveMidpoints($model_id, $midpoints) {
        if (!empty($midpoints)) {
            $i = 0;
            foreach ($midpoints as $midpoint) {
                $mp = array(
                    'advertise_id' => $model_id,
                    'order' => $i++,
                    'city_id' => $midpoint,
                );
                Midpoint::insert($mp);
            }
        }
    }

    /**
     *
     */
    protected function saveDates($model_id, $dates) {
        if (!empty($dates)) {
            $i = 0;
            foreach ($dates as $date) {
                $d = array(
                    'advertise_id' => $model_id,
                    //'order' => $i++,
                    'date' => $date,
                );
                Date::insert($d);
            }
        }
    }

    /**
     *
     */
    public function add(Request $requets) {
        if (Auth::user()->cars()->count() < 1) {
            return $this->gotoTab(4)->withFlashInfo('Még nem regisztrált gépjárművet!');
        }
        return $this->gotoTab(1);
    }

    /**
     *
     */
    private function getCity($cityId, $cityName) {
        if ($cityId) {
            return $cityId;
        } else {
            return City::getCityByName($cityName);
        }
    }

    /**
     *
     */
    public function store(Request $request) {
        $input = Input::all();
        //dd($input);

        $start_date = Input::get('start_date');
        $end_date = Input::get('end_date');
        if ($start_date >= $end_date) {
            return $this->redirTab(1)->withFlashDanger(__("alerts.backend.advertise.dates-error"));
        }

        $car_id = Input::get('car_id');
        if (!$this->isCarFree(0, $car_id, $start_date, $end_date)) {
            //return $this->redirTab(1)->withFlashDanger(__("alerts.backend.advertise.carnotfree-error"));
            return $this->redirTab(1)->withFlashDanger("A kiválasztott gépjármű az adott időpontban másik úton lesz!");
        }

        $publish_options = Input::get('publish_options');
        $dates = Input::get('dates');
        if (($publish_options == 'unique') && ($dates == null)) {
            return $this->redirTab(1)->withFlashDanger("Egyedi gyakoriságú útnál meg kell adni legalább egy dátumot!");
        }

        $regular = Input::get('regular') ? (Input::get('regular') ? 1 : 0) : 0;
        if (Input::get('publish_options') == 'unique') {
            $regular = null;
        }

        $model_data = array(
            'user_id'       => Auth::id(),
            'car_id'        => Input::get('car_id'),
            'free_seats'    => Input::get('free_seats'),
            'start_city_id' => $this->getCity(Input::get('start_city_id'), Input::get('start_city')), //City::getCityByName(Input::get('start_city')),
            'start_date'    => Input::get('start_date'),
            'end_city_id'   => $this->getCity(Input::get('end_city_id'), Input::get('end_city')), //City::getCityByName(Input::get('end_city')),
            'end_date'      => Input::get('end_date'),
            //'retour'        => Input::get('retour') ? (Input::get('retour') ? 1 : 0) : 0,
            'description'   => Input::get('description'),
            //'template'      => $template, //direkt
            'regular'       => $regular,
            'price'         => Input::get('price') ?? 0,
            'hours'         => Input::get('hours') ?? null,
            'status'        => Input::get('status') ?? 1,
            'highway'       => Input::get('highway') ? (Input::get('highway') ? 1 : 0) : 0,
        );

        $temp = new Advertise();
        $temp->user_id = $model_data['user_id'];
        $temp->car_id = $model_data['car_id'];
        $temp->start_city_id = $model_data['start_city_id'];
        $temp->end_city_id = $model_data['end_city_id'];
        if (!$model_data['start_city_id']) {
            return $this->redirTab(1, $temp)->withFlashDanger("A kezdőpont nem megfelelő!");
        }
        if (!$model_data['end_city_id']) {
            return $this->redirTab(1, $temp)->withFlashDanger("A végpont nem megfelelő!");
        }

        $template = Input::get('template');
        if ($template) {
            $template_data = $model_data;
            $template_data['template'] = $template;
            $template_id = Advertise::insertGetId($template_data);
            if ($template_id) {
                $this->saveMidpoints($template_id, Input::get('midpoints'));
                if (Input::get('publish_options') == 'unique') {
                    $this->saveDates($template_id, Input::get('dates'));
                }
            }
        }
        //dd($model_data);

        $model_id = Advertise::insertGetId($model_data);
        $this->saveMidpoints($model_id, Input::get('midpoints'));
        if (Input::get('publish_options') == 'unique') {
            $this->saveDates($model_id, Input::get('dates'));
        }

        $advertise = Advertise::find($model_id);
        HunterCheck::checkAdvertise($advertise); //Feladtak egy új hirdetést, ami megfelel az ön egyik hirdetésfigyelőjének!

        return $this->redirTab(2)->withFlashSuccess("Hirdetése sikeresen feladásra került.");
    }

    protected function realDelete(Advertise $model) {
        \Log::info('Real delete');
        Mail::queue(new SendMeDelete($model->user, $model));
        $routeLabel = Hazater::routeLabel($model->id);
        $model->delete();
        \Log::info('A hirdetés ('.$model->id.') törölve ' . $routeLabel);
    }

    /**
     *
     */
    public function delete($id) {
        \Log::info('Advertise.delete()');
        $flash = __('alerts.backend.advertise.deleted');
        $model = Advertise::find($id);
        if ($model) {
            if (!$model->isDeletable()) {
                return $this->show(new AdvertiseManageRequest(), $model)->withFlashInfo('A hirdetés nem törölhető!');
            }

            $count = Reserve::where('advertise_id', $id)->count();
            if ($count == 0) {
                $this->realDelete($model);
            } else {
                \Log::info('Mark as deletable');
                $model->status = Advertise::DELETABLE; // Törlésre jelölve!
                $model->save();
                Mail::send(new SendMeRevoke($model->user, $model));
                //Mail::queue(new SendMeDelete($model->user, $model));
                \Log::info('A hirdetés ('.$id.') törlésre jelölve ' . Hazater::routeLabel($id));

                $reserves = Reserve::where('advertise_id', $id)->get();
                foreach ($reserves as $reserve) {
                    //TODO: valahova le kell tárolni, hogy ha mégsem cancellálnak akkor megtegyük mi.
                    \Log::info('Értesítés törlésről ' . Hazater::routeLabel($id) . ' ('.$reserve->user->full_name.', '.$reserve->user->email.')');
                    Mail::send(new SendDelete($reserve->user, $model));
                }

                $flash = "A hirdetésre már foglaltak helyet, az utasokat értesítjük a törlési szándékáról.";
            }
        }
        return $this->redirTab(2)->withFlashSuccess($flash);
    }

    /**
     *
     */
    public function saveTemplate(Request $request) {
        //Ez a sima mentésban van!
    }

    /**
     *
     */
    public function loadTemplate(Request $request) {
        $id = Input::get('template_id');
        $advertise = Advertise::find($id);
        if ($advertise) {
            //dd($advertise);
            return $this->gotoTab(1, $advertise)->withFlashSuccess("Sablon sikeresen betöltve.");
        } else {
            return $this->gotoTab(1)->withFlashInfo("Sablon nem található!");
        }
    }

    /**
     * @param AdvertiseManageRequest $request
     * @param Advertise             $advertise
     *
     * @return mixed
     */
    public function reserve(AdvertiseManageRequest $request, $id) {
        $reserved = false;
        $reserves = [];
        $hunters = [];
        if (Auth::user()) {
            $reserved = Reserve::whereRaw("user_id=" . Auth::id() . " AND advertise_id=" . $id)->count() > 0;
            Reserve::whereRaw("(user_id=".Auth::id().")")->get();
            $hunters = Hunter::where('user_id', Auth::id())->get();
        }
        $midpoints = Midpoint::where('advertise_id', $id)->orderBy('order')->get();
        $dates = Date::where('advertise_id', $id)->orderBy('date')->get();

        return view('frontend.datasets.advertise.reserve')->with([
            'advertise' => Advertise::find($id),
            'reserve' => null,
            'reserved' => $reserved,
            'reserves' => $reserves,
            'midpoints' => $midpoints,
            'hunter' => new Hunter(),
            'hunters' => $hunters,
            'dates' => $dates,
        ])->withFlashSuccess('Helyfoglalása sikeresen rögzítésre került.');
    }

    /**
     *
     */
    public function resign(Request $request) {
        $user = Auth::user();
        $advertise_id = Input::get('advertise_id');
        \Log::info('Helyfoglalás visszavonása ' . Hazater::routeLabel($advertise_id) . ' (' . $user->full_name . ', ' . $user->email . ')');

        DB::table('reserves')->where('user_id', $user->id)->where('advertise_id','=',$advertise_id)->delete();
        $advertise = Advertise::find($advertise_id);
        if ($advertise) {
            $advertise->free_seats++;
            $advertise->save();
            Mail::send(new SendCancel(Auth::getUser(), $advertise)); //TODO: lehet olyan levelet kap, amiben már törlődött a hirdetés
            Mail::send(new SendMeCancel($advertise->user, $advertise)); //TODO: lehet olyan levelet kap, amiben már törlődött a hirdetés
            if ($advertise->status == Advertise::DELETABLE) {
                $count = Reserve::where('advertise_id', $advertise_id)->count();
                if ($count == 0) {
                    $this->realDelete($advertise);
                }
            }
        }

        return redirect()->route('frontend.user.passanger.menu')->withFlashSuccess('Helyfoglalása sikeresen törlésre került.');
    }

}
