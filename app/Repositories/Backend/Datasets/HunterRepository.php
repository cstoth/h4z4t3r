<?php

namespace App\Repositories\Backend\Datasets;

use App\Models\Hunter;
use App\Models\City;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Events\Backend\Datasets\Hunter\HunterCreated;
use App\Events\Backend\Datasets\Hunter\HunterUpdated;

/**
 * Class HunterRepository.
 */
class HunterRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Hunter::class;
    }

    /**
     * @param array $data
     *
     * @return Hunter
     * @throws GeneralException
     */
    public function create(array $data) : Hunter
    {
        return DB::transaction(function () use ($data) {
            $model = parent::create([
                'user_id'       => $data['user_id'],
                'start_city_id' => $data['start_city_id'] ?? City::getCityIdByName($data['start_city']),
                'end_city_id'   => $data['end_city_id'] ?? City::getCityIdByName($data['end_city']),
                'days'          => $data['days'],
                //'active'        => isset($data['active']) ? ($data['active'] ? 1 : 0) : 0,
                'active'        => 1, // allways active
            ]);

            if ($model) {
                // event(new HunterCreated($model));
                return $model;
            }

            throw new GeneralException(trans('exceptions.backend.datasets.hunter.create_error'));
        });
    }

    /**
     * @param Hunter  $model
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function update(Hunter $model, array $data)
    {
        return DB::transaction(function () use ($model, $data) {
            if ($model->update([
                'user_id'       => $data['user_id'],
                'start_city_id' => $data['start_city_id'] ?? City::getCityIdByName($data['start_city']),
                'end_city_id'   => $data['end_city_id'] ?? City::getCityIdByName($data['end_city']),
                'days'          => $data['days'],
                'active'        => $data['active'] ?? 0,
            ])) {
                // event(new HunterUpdated($model));
                return $model;
            }

            throw new GeneralException(trans('exceptions.backend.datasets.hunter.update_error'));
        });
    }
}
