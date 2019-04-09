<?php

namespace App\Http\Controllers\Frontend\Datasets;

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
class CarController extends Controller {
    /**
     * @var CarRepository
     */
    protected $carRepository;

    /**
     * @param CarRepository       $carRepository
     */
    public function __construct(CarRepository $carRepository) {
        $this->modelRepository = $carRepository;
    }

    /**
     * @param CarManageRequest $request
     *
     * @return mixed
     */
    public function index(CarManageRequest $request) {
        return view('frontend.datasets.car.index')
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
    public function create(CarManageRequest $request) {
        return view('frontend.datasets.car.create');
    }

    /**
     * @param CarStoreRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function store(CarStoreRequest $request) {
        //dd($request);
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
            ),
            $request->has('image') ? $request->file('image') : false,
            $request->has('image2') ? $request->file('image2') : false
        );

        //return redirect()->route('frontend.datasets.car.index')->withFlashSuccess(__('alerts.backend.car.created'));
        return redirect()->route('frontend.user.driver.cars')->withFlashSuccess(__('alerts.backend.car.created'));
    }

    /**
     * @param CarManageRequest $request
     * @param Car              $car
     *
     * @return mixed
     */
    public function show(CarManageRequest $request, Car $car) {
        return view('frontend.datasets.car.show')->withCar($car);
    }

    /**
     * @param CarManageRequest $request
     * @param Car              $car
     *
     * @return mixed
     */
    public function edit(CarManageRequest $request, Car $car) {
        return view('frontend.datasets.car.edit')->withCar($car);
    }

    /**
     * @param CarUpdateRequest $request
     * @param Car              $car
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(CarUpdateRequest $request, Car $car) {
        \Log::debug($request);
        $this->modelRepository->update(
            $car,
            $request->only(
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
            ),
            $request->has('image') ? $request->file('image') : false,
            $request->has('image2') ? $request->file('image2') : false
        );

        //return redirect()->route('frontend.datasets.car.index')->withFlashSuccess(__('alerts.backend.car.updated'));
        return redirect()->route('frontend.user.driver.cars')->withFlashSuccess(__('alerts.backend.car.updated'));
    }

    /**
     * @param CarManageRequest $request
     * @param Car              $car
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(CarManageRequest $request, Car $car) {
        $this->modelRepository->deleteById($car->id);

        // TODO event(new CarDeleted($car));

        return redirect()->route('frontend.datasets.car.index')->withFlashSuccess(__('alerts.backend.car.deleted'));
    }

    /**
     *
     */
    public function get($id) {
        $model = Car::find($id);
        $model['user'] = $model->user->full_name;
        return $model;
    }
}
