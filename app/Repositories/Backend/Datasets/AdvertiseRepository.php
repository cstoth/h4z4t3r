<?php

namespace App\Repositories\Backend\Datasets;

use App\Models\Advertise;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\City;
use App\Models\Midpoint;
use App\Models\Date;
//use App\Events\Backend\Datasets\Advertise\AdvertiseCreated;
//use App\Events\Backend\Datasets\Advertise\AdvertiseUpdated;

/**
 * Class AdvertiseRepository.
 */
class AdvertiseRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Advertise::class;
    }

    /**
     * @param array $data
     *
     * @return Advertise
     * @throws GeneralException
     */
    public function create(array $data) : Advertise
    {
        // var_dump($data);
        // die;

        return DB::transaction(function () use ($data) {
            if (!isset($data['start_city_id'])) {
                if (isset($data['start_city'])) {
                    $data['start_city_id'] = $this->getCityIdByName($data['start_city']);
                }
            }
            if (!isset($data['end_city_id'])) {
                if (isset($data['end_city'])) {
                    $data['end_city_id'] = $this->getCityIdByName($data['end_city']);
                }
            }

            $model = parent::create([
                'user_id'       => Auth::user()->id, // TODO vizsgálat: van-e user_id az users-ben?
                'car_id'        => $data['car_id'], // TODO vizsgálat
                'start_city_id' => $data['start_city_id'], // TODO vizsgálat
                'end_city_id'   => $data['end_city_id'], // TODO vizsgálat
                'start_date'    => $data['start_date'],
                'end_date'      => $data['end_date'],
                'free_seats'    => $data['free_seats'],
                //'retour'        => $data['retour'] ?? 0,
                'description'   => $data['description'] ?? null,
                'template'      => $data['template'] ?? null,
                'regular'       => $data['regular'] ?? 0,
                'price'         => $data['price'] ?? 0,
                'hours'         => $data['hours'] ?? null,
                'status'        => $data['status'] ?? 1,
                'highway'       => $data['highway'] ?? true,
            ]);

            if ($model) {
                // TODO event(new AdvertiseCreated($model));
                return $model;
            }

            throw new GeneralException(trans('exceptions.backend.datasets.advertise.create_error'));
        });
    }

    public function getCityIdByName($name) {
        $city = City::select("id")->where("name", "=", "{$name}")->first();
        return $city['id'];
    }

    /**
     * @param Advertise  $model
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function update(Advertise $model, array $data)
    {
        return DB::transaction(function () use ($model, $data) {
            //dd($data);
            if (!isset($data['start_city_id'])) {
                if (isset($data['start_city'])) {
                    $data['start_city_id'] = $this->getCityIdByName($data['start_city']);
                } else {
                    $data['start_city_id'] = null; //error
                }
            }
            if (!isset($data['end_city_id'])) {
                if (isset($data['end_city'])) {
                    $data['end_city_id'] = $this->getCityIdByName($data['end_city']);
                } else {
                    $data['end_city_id'] = null; //error
                }
            }

            $regular = 1; //isset($data['regular']) && $data['regular'] == '1' ? 1 : 0;
            $publish_options = 'regular';
            if (isset($data['publish_options'])) {
                $publish_options = $data['publish_options'];
            }
            // if ($data['publish_options'] == 'unique') {
            //     $regular = null;
            // }

            if ($model->update([
                'user_id'       => Auth::user()->id, // TODO vizsgálat: van-e user_id az users-ben?
                'car_id'        => $data['car_id'], // TODO vizsgálat
                'start_city_id' => $data['start_city_id'], // TODO vizsgálat
                'end_city_id'   => $data['end_city_id'], // TODO vizsgálat
                'start_date'    => $data['start_date'],
                'end_date'      => $data['end_date'],
                'free_seats'    => $data['free_seats'],
                //'retour'        => isset($data['retour']) && $data['retour'] == '1' ? 1 : 0,
                'description'   => $data['description'] ?? null,
                'template'      => $data['template'] ?? null,
                'regular'       => $regular,
                'price'         => $data['price'] ?? 0,
                'hours'         => $data['hours'] ?? null,
                'status'        => $data['status'] ?? 1,
                'highway'       => isset($data['highway']) ? ($data['highway'] == 'on' ? 1 : 0) : 0,
            ])) {
                // TODO event(new AdvertiseUpdated($model));
                Midpoint::where('advertise_id', $model->id)->delete();
                if (isset($data['midpoints'])) {
                    $i = 0;
                    foreach ($data['midpoints'] as $midpoint) {
                        $mp = array(
                            'advertise_id' => $model->id,
                            'order' => $i++,
                            'city_id' => $midpoint,
                        );
                        Midpoint::insert($mp);
                    }
                }

                Date::where('advertise_id', $model->id)->delete();
                // if ($publish_options == 'unique') {
                //     if (isset($data['dates'])) {
                //         $i = 0;
                //         foreach ($data['dates'] as $date) {
                //             $d = array(
                //                 'advertise_id' => $model->id,
                //                 //'order' => $i++,
                //                 'date' => $date,
                //             );
                //             Date::insert($d);
                //         }
                //     }
                // }

                return $model;
            }

            throw new GeneralException(trans('exceptions.backend.datasets.advertise.update_error'));
        });
    }
}
