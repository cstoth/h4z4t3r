<?php

namespace App\Repositories\Backend\Datasets;

use App\Models\Messages;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
//use App\Events\Backend\Datasets\Message\MessageCreated;
//use App\Events\Backend\Datasets\Message\MessageUpdated;

/**
 * Class MessageRepository.
 */
class MessageRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Messages::class;
    }

    /**
     * @param array $data
     *
     * @return Messages
     * @throws GeneralException
     */
    public function create(array $data) : Messages
    {
        return DB::transaction(function () use ($data) {
            $model = parent::create([
                'from_user_id'  => $data['from_user_id'], // TODO vizsgálat: van-e user_id az users-ben?
                'to_user_id'    => $data['to_user_id'], // TODO vizsgálat: van-e user_id az users-ben?
                'advertise_id'  => $data['advertise_id'], // TODO vizsgálat: van-e user_id az users-ben?
                'subject'       => $data['subject'],
                'message'       => $data['message'],
            ]);

            if ($model) {
                // TODO event(new MessageCreated($model));
                return $model;
            }

            throw new GeneralException(trans('exceptions.backend.datasets.car.create_error'));
        });
    }

    /**
     * @param Messages  $model
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function update(Messages $model, array $data)
    {
        return DB::transaction(function () use ($model, $data) {
            if ($model->update([
                'from_user_id'  => $data['from_user_id'], // TODO vizsgálat: van-e user_id az users-ben?
                'to_user_id'    => $data['to_user_id'], // TODO vizsgálat: van-e user_id az users-ben?
                'advertise_id'  => $data['advertise_id'], // TODO vizsgálat: van-e user_id az users-ben?
                'subject'       => $data['subject'],
                'message'       => $data['message'],
                'readed'        => isset($data['readed']) && $data['readed'] == '1' ? 1 : 0,
            ])) {
                // TODO event(new MessageUpdated($model));
                return $model;
            }

            throw new GeneralException(trans('exceptions.backend.datasets.cities.update_error'));
        });
    }
}
