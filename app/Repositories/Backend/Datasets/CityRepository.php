<?php

namespace App\Repositories\Backend\Datasets;

use App\Models\City;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Events\Backend\Datasets\City\CityCreated;
use App\Events\Backend\Datasets\City\CityUpdated;

/**
 * Class CityRepository.
 */
class CityRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return City::class;
    }

    /**
     * @param array $data
     *
     * @return City
     * @throws GeneralException
     */
    public function create(array $data) : City
    {
        // Make sure it doesn't already exist
        if ($this->exists($data['name'])) {
            throw new GeneralException($data['name'].' nevű település már létezik!');
        }

        return DB::transaction(function () use ($data) {
            $model = parent::create([
                'name' => $data['name'],
                'kshkod' => $data['kshkod'],
                'irsz' => $data['irsz'],
                'megye' => $data['megye'],
                'x' => $data['x'],
                'y' => $data['y'],
            ]);

            if ($model) {
                event(new CityCreated($model));
                return $model;
            }

            throw new GeneralException(trans('exceptions.backend.datasets.cities.create_error'));
        });
    }

    /**
     * @param City  $model
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function update(City $model, array $data)
    {
        // If the name is changing make sure it doesn't already exist
        if ($model->name !== $data['name']) {
            if ($this->exists($data['name'])) {
                throw new GeneralException($data['name'].' nevű település már létezik!');
            }
        }

        return DB::transaction(function () use ($model, $data) {
            if ($model->update([
                'name' => $data['name'],
                'kshkod' => $data['kshkod'],
                'irsz' => $data['irsz'],
                'megye' => $data['megye'],
                'x' => $data['x'],
                'y' => $data['y'],
            ])) {
                event(new CityUpdated($model));
                return $model;
            }

            throw new GeneralException(trans('exceptions.backend.datasets.cities.update_error'));
        });
    }

    /**
     * @param $name
     *
     * @return bool
     */
    protected function exists($name) : bool
    {
        return $this->model
                ->where('name', strtolower($name))
                ->count() > 0;
    }
}
