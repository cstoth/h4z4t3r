<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
use App\Models\Advertise;

class Passanger extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'advertise_id',
    ];

    /**
     *
     */
    public static $rules = [
        // 'to_user_id' => 'required',
        // 'subject' => 'required',
        // 'message' => 'required',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * @var array
     */
    protected $dates = [];

    /**
     * The dynamic attributes from mutators that should be returned with the user object.
     * @var array
     */
    protected $appends = []; // 'full_name'

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'active' => 'boolean',
        // 'confirmed' => 'boolean',
    ];

    /**
     * The relationship to the from-user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return string
     */
    public function getUserLabelAttribute()
    {
        return $this->user->full_name . " " . $this->user->phone;
    }

    /**
     * @return string
     */
    public function getRouteLabelAttribute()
    {
        return $this->advertise->getRouteLabelAttribute();
    }

    /**
     * The relationship to the from-user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advertise()
    {
        return $this->belongsTo(Advertise::class, 'advertise_id');
    }

    /**
     * @return string
     */
    public function getAdvertiseLabelAttribute()
    {
        //TODO ide mad kell egy leírás féle, pl: from-to dates ...
        return $this->advertise->id;
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a
            id="passanger-show-{{$this->id}}"
            data-key="'.$this->id.'"
            data-toggle="tooltip"
            data-placement="top"
            title="'.__('buttons.general.crud.view').'"
            class="btn btn-info"><i class="fas fa-eye"></i></a>';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a
            id="passanger-edit-{{$this->id}}"
            data-key="'.$this->id.'"
            data-toggle="tooltip"
            data-placement="top"
            title="'.__('buttons.general.crud.edit').'"
            class="btn btn-success"><i class="fas fa-edit"></i></a>';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if ($this->user_id == auth()->id()) {
            return '<a href="'.route('frontend.passanger.delete', $this).'"
                title="'.__('buttons.general.crud.delete').'"
                data-key="'.$this->id.'"
                data-method="delete"
                data-trans-button-cancel="'.__('buttons.general.cancel').'"
                data-trans-button-confirm="'.__('buttons.general.crud.delete').'"
                data-trans-title="'.__('strings.backend.general.are_you_sure').'"
                class="btn btn-danger"><i class="fas fa-trash"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getMessageButtonAttribute()
    {
        // href="'.route('admin.auth.user.edit', $this).'"
        return '<a
            id="passanger-message-{{$this->id}}"
            data-key="'.$this->id.'"
            data-user="'.$this->user->id.'"
            data-advertise="'.$this->advertise->id.'"
            data-route="'.$this->advertise->route_label.'"
            data-toggle="tooltip"
            data-placement="top"
            title="Üzenet küldése"
            class="btn btn-success"><i class="fas fa-envelope"></i></a>';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        // if ($this->trashed()) {
        //     return '
		// 		<div class="btn-group" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">
		// 		  '.$this->restore_button.'
		// 		  '.$this->delete_permanently_button.'
		// 		</div>';
        // }

        return '<div id="passanger-buttons" class="btn-group" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">
            '.$this->message_button.'
		</div>';
        // '.$this->show_button.'
        // '.$this->edit_button.'
        // '.$this->delete_button.'
    }
}
