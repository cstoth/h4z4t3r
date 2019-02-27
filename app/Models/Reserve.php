<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
use App\Models\Advertise;

class Reserve extends Model
{
    protected $table = "reserves";
    protected $primaryKey = "id";
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'advertise_id',
        'description',
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
    public function user() {
        return $this->belongsTo(user::class, 'user_id');
    }

    /**
     * @return string
     */
    public function getUserLabelAttribute() {
        if ($this->user) {
            return $this->user->full_name . " " . $this->user->phone;
        }
        return "";
    }

    /**
     * @return string
     */
    public function getUserLinkLabelAttribute() {
        if ($this->user) {
            // return '<a href="mailto:'.$this->user->email.'" target="_top">'.$this->user->full_name . " " . $this->user->phone.'</a>';
            return '<a href="' . route('frontend.user.profile.show', $this->user->id) . '">' . $this->user->full_name . '</a>';
        }
        return "";
    }

    /**
     * @return string
     */
    public function getUserNameLabelAttribute() {
        if ($this->user) {
            return $this->user->full_name;
        }
        return "";
    }

    /**
     * @return string
     */
    public function getUserPhoneLabelAttribute() {
        if ($this->user) {
            return $this->user->phone;
        }
        return "";
    }

    /**
     * @return string
     */
    public function getUserEmailLabelAttribute() {
        if ($this->user) {
            return '<a href="mailto:'.$this->user->email.'" target="_top">'.$this->user->email.'</a>';
        }
        return "";
    }

    /**
     * @return string
     */
    public function getFromToLabelAttribute() {
        return $this->advertise->from_to_label;
    }

    /**
     * @return string
     */
    public function getStartEndLabelAttribute() {
        return $this->advertise->dates_label;
    }

    /**
     * @return string
     */
    public function getDriverLabelAttribute() {
        return $this->advertise->user->full_name;
    }

    /**
     * The relationship to the from-user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advertise() {
        return $this->belongsTo(advertise::class, 'advertise_id');
    }

    /**
     * @return string
     */
    public function getAdvertiseLabelAttribute() {
        //TODO ide mad kell egy leírás féle, pl: from-to dates ...
        return $this->advertise->id;
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute() {
        return '<a href="'.route('frontend.advertise.reserve', $this->advertise_id).'"
            id="reserve-show-{{$this->id}}"
            data-key="'.$this->id.'"
            data-toggle="tooltip"
            data-placement="top"
            title="'.__('buttons.general.crud.view').'"
            class="btn btn-info"><i class="fas fa-eye"></i></a>';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute() {
        // href="'.route('admin.auth.user.edit', $this).'"
        return '<a
            id="reserve-edit-{{$this->id}}"
            data-key="'.$this->id.'"
            data-toggle="tooltip"
            data-placement="top"
            title="'.__('buttons.general.crud.edit').'"
            class="btn btn-success"><i class="fas fa-edit"></i></a>';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute() {
        if ($this->user_id == auth()->id()) {
            return '<a href="'.route('frontend.user.reserve.destroy', $this).'"
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
    public function getActionButtonsAttribute() {
        return '<div id="passanger-buttons" class="btn-group" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">
            '.$this->show_button.'
            '.$this->delete_button.'
		</div>';
    }
}
