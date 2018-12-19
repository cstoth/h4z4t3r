<?php

namespace App\Http\Controllers\Backend\Datasets;

use App\Models\City;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Datasets\CityRepository;
use App\Events\Backend\Datasets\City\CityDeleted;
use App\Http\Requests\Backend\Datasets\City\CityStoreRequest;
use App\Http\Requests\Backend\Datasets\City\CityManageRequest;
use App\Http\Requests\Backend\Datasets\City\CityUpdateRequest;

/**
 * Class CityController.
 */
class CityController extends Controller
{
    /**
     * @var CityRepository
     */
    protected $cityRepository;

    /**
     * @param CityRepository       $cityRepository
     */
    public function __construct(CityRepository $cityRepository)
    {
        $this->modelRepository = $cityRepository;
    }

    /**
     * @param CityManageRequest $request
     *
     * @return mixed
     */
    public function index(CityManageRequest $request)
    {
        return view('backend.datasets.city.index')
            ->withCities($this->modelRepository
                ->orderBy('id', 'asc')
                ->paginate(10)
            );
    }

    /**
     * @param CityManageRequest $request
     *
     * @return mixed
     */
    public function create(CityManageRequest $request)
    {
        return view('backend.datasets.city.create');
    }

    /**
     * @param CityStoreRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function store(CityStoreRequest $request)
    {
        $this->modelRepository->create($request->only(
            'name',
            'kshkod',
            'irsz',
            'megye',
            'x',
            'y'
        ));

        return redirect()->route('admin.datasets.city.index')->withFlashSuccess(__('alerts.backend.city.created'));
    }

    /**
     * @param CityManageRequest $request
     * @param City              $city
     *
     * @return mixed
     */
    public function edit(CityManageRequest $request, City $city)
    {
        return view('backend.datasets.city.edit')
            ->withCity($city);
    }

    /**
     * @param CityUpdateRequest $request
     * @param City              $city
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(CityUpdateRequest $request, City $city)
    {
        $this->modelRepository->update($city, $request->only(
            'name',
            'kshkod',
            'irsz',
            'megye',
            'x',
            'y'
        ));

        return redirect()->route('admin.datasets.city.index')->withFlashSuccess(__('alerts.backend.city.updated'));
    }

    /**
     * @param CityManageRequest $request
     * @param City              $city
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(CityManageRequest $request, City $city)
    {
        $this->modelRepository->deleteById($city->id);

        // event(new CityDeleted($city));

        return redirect()->route('admin.datasets.city.index')->withFlashSuccess(__('alerts.backend.city.deleted'));
    }
}
