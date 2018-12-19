<?php

namespace App\Repositories\Backend\Datasets;

use App\Models\Car;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
//use App\Events\Backend\Datasets\Car\CarCreated;
//use App\Events\Backend\Datasets\Car\CarUpdated;

/**
 * Class CarRepository.
 */
class CarRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Car::class;
    }

    /**
     * @param array $data
     *
     * @return Car
     * @throws GeneralException
     */
    public function create(array $data, $image = false, $image2 = false) : Car
    {
        // Make sure it doesn't already exist
        if ($this->exists($data['license'])) {
            throw new GeneralException($data['license'].' rendszámú gépjármű már létezik!');
        }

        return DB::transaction(function () use ($data, $image, $image2) {
            $model = parent::create([
                'user_id'   => $data['user_id'], // TODO vizsgálat: van-e user_id az users-ben?
                'license'   => strtoupper($data['license']),
                'brand'     => $data['brand'],
                'type'      => $data['type'],
                'color'     => $data['color'],
                'seats'     => $data['seats'],
                'year'      => $data['year'],
                'image'     => $this->storeImage($image),
                'image2'    => $this->storeImage($image2),
                'smoke'     => isset($data['smoke']) && $data['smoke'] == '1' ? 1 : 0,
                'cooler'    => isset($data['cooler']) && $data['cooler'] == '1' ? 1 : 0,
                'pet'       => isset($data['pet']) && $data['pet'] == '1' ? 1 : 0,
                'bag'       => isset($data['bag']) && $data['bag'] == '1' ? 1 : 0,
            ]);

            if ($model) {
                // TODO event(new CarCreated($model));
                return $model;
            }

            throw new GeneralException(trans('exceptions.backend.datasets.car.create_error'));
        });
    }

    public function storeImage($image) {
        if ($image) {
            return $image->store('/cars', 'public');
        }
        return null;
    }

    /**
     * @param Car  $model
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function update(Car $model, array $data, $image = false, $image2 = false)
    {
        // If the name is changing make sure it doesn't already exist
        if ($model->license !== $data['license']) {
            if ($this->exists($data['license'])) {
                throw new GeneralException($data['license'].' rendszámú gépjármű már létezik!');
            }
        }

        return DB::transaction(function () use ($model, $data, $image, $image2) {
            if ($model->update([
                'user_id'   => $data['user_id'],  // TODO vizsgálat: van-e user_id az users-ben?
                'license'   => strtoupper($data['license']),
                'brand'     => $data['brand'],
                'type'      => $data['type'],
                'color'     => $data['color'],
                'seats'     => $data['seats'],
                'year'      => $data['year'],
                'smoke'     => isset($data['smoke']) && $data['smoke'] == '1' ? 1 : 0,
                'cooler'    => isset($data['cooler']) && $data['cooler'] == '1' ? 1 : 0,
                'pet'       => isset($data['pet']) && $data['pet'] == '1' ? 1 : 0,
                'bag'       => isset($data['bag']) && $data['bag'] == '1' ? 1 : 0,
            ])) {
                if ($image) {
                    $model['image'] = $this->storeImage($image);
                    $model->save();
                }
                if ($image2) {
                    $model['image2'] = $this->storeImage($image2);
                    $model->save();
                }
    
                // TODO event(new CarUpdated($model));
                return $model;
            }

            throw new GeneralException(trans('exceptions.backend.datasets.cities.update_error'));
        });
    }

    /**
     * @param $license
     *
     * @return bool
     */
    protected function exists($license) : bool
    {
        return $this->model
                ->where('license', strtoupper($license))
                ->count() > 0;
    }
}
