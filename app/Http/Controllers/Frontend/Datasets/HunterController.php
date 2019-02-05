<?php

namespace App\Http\Controllers\Frontend\Datasets;

use App\Models\Hunter;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Datasets\HunterRepository;
use App\Http\Requests\Backend\Datasets\Hunter\HunterStoreRequest;
use App\Http\Requests\Backend\Datasets\Hunter\HunterManageRequest;
use App\Http\Requests\Backend\Datasets\Hunter\HunterUpdateRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Models\Reserve;

/**
 * Class HunterController.
 */
class HunterController extends Controller {
    protected function getWithData($tab) {
        session_start();
        //dd($tab);
        $_SESSION["PASSANGER_TAB"] = $tab;
        return [
            'tab' => $tab,
            'cars' => Auth::user()->cars()->get(),
            'advertises' => Auth::user()->advertises()->get(),
            'reserve' => null,
            'reserved' => false,
            'reserves' => Reserve::whereRaw("(user_id=".Auth::user()->id.")")->get(),
            'hunter' => new Hunter(),
            'hunters' => Hunter::whereRaw("(user_id=".Auth::user()->id.")")->get(),
        ];
    }

    /**
     *
     */
    public function gotoTab($tab) {
        return view('frontend.user.passanger')->with($this->getWithData($tab));
    }

    /**
     *
     */
    public function redirTab($tab) {
        //dd($tab);
        return redirect()->route('frontend.user.passanger.menu')->with($this->getWithData($tab));
    }

    /**
     * @var HunterRepository
     */
    protected $repository;

    /**
     * @param HunterRepository       $repository
     */
    public function __construct(HunterRepository $repository) {
        $this->modelRepository = $repository;
    }

    /**
     * @param HunterManageRequest $request
     *
     * @return mixed
     */
    public function index(HunterManageRequest $request) {
        return view('frontend.datasets.hunter.index')
            ->withHunters($this->modelRepository
                ->orderBy('id', 'asc')
                ->paginate(10)
            );
    }

    /**
     * @param HunterManageRequest $request
     *
     * @return mixed
     */
    public function create(HunterManageRequest $request) {
        return view('frontend.datasets.hunter.create');
    }

    /**
     * @param HunterStoreRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function store(HunterStoreRequest $request) {
        //dd($request);
        $this->modelRepository->create($request->only(
            'user_id',
            'start_city',
            'start_city_id',
            'end_city',
            'end_city_id',
            //'days',
            'active'
        ));

        //return redirect()->route('frontend.datasets.hunter.index')->withFlashSuccess(__('alerts.backend.hunter.created'));
        return $this->redirTab(2)->withFlashSuccess(__('alerts.backend.hunter.created'));
    }

    /**
     * @param HunterManageRequest $request
     * @param Hunter              $model
     *
     * @return mixed
     */
    public function show(HunterManageRequest $request, Hunter $model) {
        return view('frontend.datasets.hunter.show')->withHunter($model);
    }

    /**
     * @param HunterManageRequest $request
     * @param Hunter              $model
     *
     * @return mixed
     */
    public function edit(HunterManageRequest $request, Hunter $model) {
        return view('frontend.datasets.hunter.edit')->withHunter($model);
    }

    /**
     * @param HunterUpdateRequest $request
     * @param Hunter              $model
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(HunterUpdateRequest $request, Hunter $model) {
        $this->modelRepository->update($model, $request->only(
            'user_id',
            'start_city',
            'start_city_id',
            'end_city',
            'end_city_id',
            //'days',
            'active'
        ));

        return redirect()->route('frontend.datasets.hunter.index')->withFlashSuccess(__('alerts.backend.hunter.updated'));
    }

    /**
     * @param HunterManageRequest $request
     * @param Hunter              $model
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Hunter $hunter) {
        //dd($model);
        if ($hunter->delete()) {

        }
        //$this->modelRepository->deleteById($model->id);

        //$affectedRows = Hunter::find($model->id)->delete();

        // event(new HunterDeleted($model));

        // if ($affectedRows < 1) {
        //     return $this->redirTab(2)->withFlashDanger("A törlés sikertelen!");
        // }
        return $this->redirTab(2)->withFlashSuccess(__('alerts.backend.hunter.deleted'));
    }

    /**
     *
     */
    public function get($id) {
        return Hunter::find($id);
    }

    /**
     *
     */
    public function query(Request $request) {
        return Hunter::where('name', '=', Input::get('name'))->get();
    }
}
