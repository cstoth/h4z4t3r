<?php

namespace App\Http\Controllers\Backend\Datasets;

use App\Models\Car;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Datasets\CarRepository;
// use App\Events\Backend\Datasets\Car\CarDeleted;
use App\Http\Requests\Backend\Datasets\Car\CarStoreRequest;
use App\Http\Requests\Backend\Datasets\Car\CarManageRequest;
use App\Http\Requests\Backend\Datasets\Car\CarUpdateRequest;

/**
 * Class CarController.
 */
class CarController extends Controller
{
    /**
     * @var CarRepository
     */
    protected $carRepository;

    /**
     * @param CarRepository       $carRepository
     */
    public function __construct(CarRepository $carRepository)
    {
        $this->modelRepository = $carRepository;
    }

    /**
     * @param CarManageRequest $request
     *
     * @return mixed
     */
    public function index(CarManageRequest $request)
    {
        return view('backend.datasets.car.index')
            ->withCars($this->modelRepository
                ->orderBy('id', 'asc')
                ->paginate(10)
            );
    }

    /**
     * @param CarManageRequest $request
     *
     * @return mixed
     */
    public function create(CarManageRequest $request)
    {
        return view('backend.datasets.car.create');
    }

    /**
     * @param CarStoreRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function store(CarStoreRequest $request)
    {
        $this->modelRepository->create($request->only(
            'user_id',
            'license',
            'type',
            'seats',
            'brand',
            'color',
            'year',
            'image',
            'image2',
            'smoke',
            'cooler',
            'pet',
            'bag'
        ));

        return redirect()->route('admin.datasets.car.index')->withFlashSuccess(__('alerts.backend.car.created'));
    }

    /**
     * @param CarManageRequest $request
     * @param Car              $car
     *
     * @return mixed
     */
    public function show(CarManageRequest $request, Car $car)
    {
        return view('backend.datasets.car.show')->withCar($car);
    }

    /**
     * @param CarManageRequest $request
     * @param Car              $car
     *
     * @return mixed
     */
    public function edit(CarManageRequest $request, Car $car)
    {
        return view('backend.datasets.car.edit')->withCar($car);
    }

    /**
     * @param CarUpdateRequest $request
     * @param Car              $car
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(CarUpdateRequest $request, Car $car)
    {
        $this->modelRepository->update($car, $request->only(
            'user_id',
            'license',
            'type',
            'seats',
            'brand',
            'color',
            'year',
            'image',
            'image2',
            'smoke',
            'cooler',
            'pet',
            'bag'
        ));

        return redirect()->route('admin.datasets.car.index')->withFlashSuccess(__('alerts.backend.car.updated'));
    }

    /**
     * @param CarManageRequest $request
     * @param Car              $car
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(CarManageRequest $request, Car $car)
    {
        $this->modelRepository->deleteById($car->id);

        // TODO event(new CarDeleted($car));

        return redirect()->route('admin.datasets.car.index')->withFlashSuccess(__('alerts.backend.car.deleted'));
    }
}
