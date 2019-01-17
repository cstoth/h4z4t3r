<?php

namespace App\Http\Controllers\Frontend\Datasets;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Datasets\Advertise\AdvertiseManageRequest;
use App\Http\Requests\Backend\Datasets\Advertise\AdvertiseStoreRequest;
// use App\Events\Backend\Datasets\Advertise\AdvertiseDeleted;
use App\Http\Requests\Backend\Datasets\Advertise\AdvertiseUpdateRequest;
use App\Models\Advertise;
use App\Models\Car;
use App\Repositories\Backend\Datasets\AdvertiseRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Passanger;
use App\Helpers\Hazater;
use App\Models\Midpoint;
use App\Mail\Frontend\SendAdvertise;
use Illuminate\Support\Facades\Mail;
use App\Models\Reserve;
use App\Mail\Frontend\SendMeAdvertise;
use App\Models\Date;
use App\Models\Hunter;
use App\Console\Commands\HunterCheck;

/**
 * Class AdvertiseController.
 */
class AdvertiseController extends Controller
{
    /**
     * @var AdvertiseRepository
     */
    protected $repository;

    /**
     * @param AdvertiseRepository       $repository
     */
    public function __construct(AdvertiseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param AdvertiseManageRequest $request
     *
     * @return mixed
     */
    public function index(AdvertiseManageRequest $request)
    {
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
    public function create(AdvertiseManageRequest $request)
    {
        $cars = Car::where('user_id', Auth::user()->id)->get();
        return view('frontend.datasets.advertise.create')->withCars($cars);
    }

    /**
     * @param AdvertiseStoreRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function store(AdvertiseStoreRequest $request)
    {
        return redirect()->route('frontend.user.driver.menu')->withFlashSuccess(__('alerts.backend.advertise.created'));
    }

    /**
     * @param AdvertiseManageRequest $request
     * @param Advertise             $advertise
     *
     * @return mixed
     */
    public function show(AdvertiseManageRequest $request, Advertise $advertise)
    {
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
    public function edit(AdvertiseManageRequest $request, Advertise $advertise)
    {
        if (!Auth::user()) return redirect()->route('frontend.auth.login')->withFlashInfo('A munkamenete lejárt, jelentkezzen be ismét!');

        $advertises = Advertise::whereRaw('user_id='.Auth::user()->id.' AND template IS NULL');
        $passangers = Passanger::whereRaw('advertise_id IN (SELECT id FROM advertises WHERE user_id='.Auth::user()->id.')');
        $templates = Advertise::whereRaw('user_id='.Auth::user()->id.' AND template IS NOT NULL');
        $midpoints = Midpoint::where('advertise_id', $advertise->id)->orderBy('order');
        $hunters = Hunter::where('user_id', Auth::user()->id);
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
            // $mp = new Midpoint();
            // $mp->advertise_id = $to->id;
            // $mp->city_id = $midpoint->city_id;
            // $mp->order = $midpoint->order;
            $mp->save();
        }
    }

    /**
     * @param AdvertiseManageRequest $request
     * @param Advertise             $advertise
     *
     * @return mixed
     */
    public function copy(AdvertiseManageRequest $request, Advertise $advertise)
    {
        $copied = $advertise->replicate();
        $copied->start_date = null;
        $copied->end_date = null;
        $copied->save();
        $this->copyMidPoints($advertise, $copied);
        return $this->edit($request, $copied);
    }

    /**
     * @param AdvertiseUpdateRequest $request
     * @param Advertise             $advertise
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(AdvertiseUpdateRequest $request, Advertise $advertise)
    {
        //dd($request);

        if ($request['start_date'] >= $request['end_date']) {
            return redirect()->route('frontend.datasets.advertise.edit', $advertise)->withFlashDanger(__("alerts.backend.advertise.dates-error"));
        }
        if (($request['publish_options'] == 'unique') && ($request['dates'] == null)) {
            return redirect()->route('frontend.datasets.advertise.edit', $advertise)->withFlashDanger("Egyedi gyakoriságú útnál meg kell adni legalább egy dátumot!");
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
            'price',
            'hours',
            'status',
            'highway',
            'publish_options',
            'dates'
        ));

        //TODO: mail!
        \Log::info('A hirdetés ('.$advertise->id.') módosult ' . Hazater::routeLabel($advertise->id));
        Mail::send(new SendMeAdvertise($advertise->user, $advertise));
        $reserves = Reserve::where('advertise_id', $advertise->id)->get();
        foreach ($reserves as $reserve) {
            Mail::send(new SendAdvertise($reserve->user, $advertise));
        }
        HunterCheck::checkAdvertise($advertise); //A módosult hirdetés megfelel egy hirdetés vadásznak?

        return redirect()->route('frontend.user.driver.menu')->withFlashSuccess(__('alerts.backend.advertise.updated'));
    }

    /**
     * 
     */
    public function close(Advertise $advertise) {
        $advertise->status = Advertise::CLOSED;
        $advertise->save();
    }

    /**
     * @param AdvertiseManageRequest $request
     * @param Advertise             $advertise
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(AdvertiseManageRequest $request, Advertise $advertise)
    {
        //dd($request);
        $this->repository->deleteById($advertise->id);

        // TODO event(new AdvertiseDeleted($advertise));

        return redirect()->route('frontend.datasets.advertise.index')->withFlashSuccess(__('alerts.backend.advertise.deleted'));
    }
}
