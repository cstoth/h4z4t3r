<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
use App\Models\Car;
use App\Models\Advertise;
use App\Helpers\Hazater;

class Advertise extends Model
{
    public const INACTIVE   = 0;
    public const ACTIVE     = 1;
    public const DELETABLE  = 2;
    public const PROGRESS   = 3;
    public const FINISHED   = 4;
    public const CLOSED     = 5;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'template',
        'regular',
        'start_city_id',
        'end_city_id',
        'start_date',
        'end_date',
        'free_seats',
        'retour',
        'description',
        'regular',
        'status',
        'price',
        'hours',
        'highway',
    ];

    /**
     *
     */
    public static $rules = [
        // 'start_date' => 'required',
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
        'retour' => 'boolean',
        'highway' => 'boolean',
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
        return $this->user->full_name;
    }

    /**
     * The relationship to the from-user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    /**
     * @return string
     */
    public function getCarLabelAttribute()
    {
        return isset($this->car) ? $this->car->name : "";
    }

    /**
     * The relationship to the from-user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function startCity()
    {
        return $this->belongsTo(City::class, 'start_city_id');
    }

    /**
     * @return string
     */
    public function getStartCityLabelAttribute()
    {
        return isset($this->startCity) ? $this->startCity->name : "";
    }

    /**
     * The relationship to the from-user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function endCity()
    {
        return $this->belongsTo(City::class, 'end_city_id');
    }

    /**
     * @return string
     */
    public function getEndCityLabelAttribute()
    {
        return isset($this->endCity) ? $this->endCity->name : "";
    }

    /**
     *
     */
    public function getFromToLabelAttribute()
    {
        $route = $this->getStartCityLabelAttribute();
        $midpoints = Midpoint::where('advertise_id', $this->id)->orderBy('order')->get();
        $i = 0;
        foreach ($midpoints as $midpoint) {
            if ($i++ < 3) {
                $route .= " -> " . $midpoint->city->name;
            }
        }
        $route .= " -> " . $this->getEndCityLabelAttribute();
        return $route;
    }

    /**
     *
     */
    public function getStartingDateAttribute() {
        return Hazater::formatDate($this->start_date);
    }

    /**
     *
     */
    public function getStartDateLabelAttribute() {
        return Hazater::formatDate($this->start_date);
    }

    /**
     *
     */
    public function getEndingDateAttribute() {
        return Hazater::formatDate($this->end_date);
    }

    /**
     *
     */
    public function getEndDateLabelAttribute() {
        return Hazater::formatDate($this->end_date);
    }

    /**
     *
     */
    public function getDatesLabelAttribute()
    {
        return $this->starting_date . " -> " . $this->ending_date;
    }

    /**
     *
     */
    public function getRouteLabelAttribute()
    {
        return $this->getFromToLabelAttribute() . " " . $this->starting_date;
    }

    /**
     *
     */
    public function getCitiesLabelAttribute()
    {
        //return $this->start_city_label . " -> " . $this->end_city_label;
        return $this->getFromToLabelAttribute();
    }

    /**
     *
     */
    public function getSeatsLabelAttribute()
    {
        return $this->free_seats;
    }

    protected $statusLabels = ['inaktív', 'aktív', 'törölt', 'lejárt'];

    protected $statusColors = ['badge-secondary', 'badge-success', 'badge-danger', 'badge-dark'];

    /**
     *
     */
    public function getStatusLabelAttribute()
    {
        return '<span class="badge '.$this->statusColors[$this->status].'">'.$this->statusLabels[$this->status].'</span>';
    }

    /**
     * @return bool
     */
    public function isTemplate()
    {
        return isset($this->template);
    }

    public function getBoolItem($bool) {
        if ($bool) {
            return '<span class="badge badge-success" style="cursor:pointer">'.__('labels.general.yes').'</span>';
        } else {
            return '<span class="badge badge-danger" style="cursor:pointer">'.__('labels.general.no').'</span>';
        }
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route('frontend.datasets.advertise.show', $this).'"
            id="advertise-show-'.$this->id.'"
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
        return '<a href="'.route('frontend.datasets.advertise.edit', $this).'"
            id="advertise-edit-'.$this->id.'"
            data-key="'.$this->id.'"
            data-toggle="tooltip"
            data-placement="top"
            title="'.__('buttons.general.crud.edit').'"
            class="btn btn-success"><i class="fas fa-edit"></i></a>';
    }

    /**
     * @return string
     */
    public function getCopyButtonAttribute()
    {
        return '<a href="'.route('frontend.datasets.advertise.copy', $this).'"
            id="advertise-copy-'.$this->id.'"
            data-key="'.$this->id.'"
            data-toggle="tooltip"
            data-placement="top"
            title="'.__('buttons.general.crud.copy').'"
            class="btn btn-info"><i class="fas fa-copy"></i></a>';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if ($this->user_id == auth()->id()) {
            return '<a href="'.route('frontend.advertise.delete', $this).'"
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
    public function getActionButtonsAttribute()
    {
        return '<div id="advertise-buttons" class="btn-group" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">
            '.$this->show_button.'
            '.$this->edit_button.'
            '.$this->copy_button.'
            '.$this->delete_button.'
		</div>';
    }

}
