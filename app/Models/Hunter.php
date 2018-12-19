<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hunter.
 */
class Hunter extends Model
{
    protected $table = "hunters";
    protected $clazz = "hunter";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'start_city_id',
        'end_city_id',
        'days',
        'active',
    ];

    /**
     *
     */
    // protected $attributes = [
    //     'user_id'       => 'Felhasználó',
    //     'start_city_id' => 'Indulási hely',
    //     'end_city_id'   => 'Érkezési hely',
    //     'days'          => 'Utazás napja',
    // ];

    /**
     *
     */
    public static $rules = [
        'user_id'       => ['required'],
        'start_city'    => ['max:191'],
        'end_city'      => ['max:191'],
        'days'          => [],
    ];

    /**
     *
     */
    public function colName($colname) {
        return $attributes[$colname];
    }

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
        'active' => 'boolean',
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
        return $this->user->full_name;
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
     * @return string
     */
    public function getDaysLabelAttribute()
    {
        $d = "<div>";
        //<span class="badge badge-secondary">Secondary</span>
        if ($this->days == 1) return '<span class="badge badge-secondary">Minden nap</span>';
        $d = $d . '<span class="badge badge-' . (($this->days &   2) ? 'success' : 'secondary') . '">Hé</span>';
        $d = $d . '<span class="badge badge-' . (($this->days &   4) ? 'success' : 'secondary') . '">Ke</span>';
        $d = $d . '<span class="badge badge-' . (($this->days &   8) ? 'success' : 'secondary') . '">Sze</span>';
        $d = $d . '<span class="badge badge-' . (($this->days &  16) ? 'success' : 'secondary') . '">Cs</span>';
        $d = $d . '<span class="badge badge-' . (($this->days &  32) ? 'success' : 'secondary') . '">Pé</span>';
        $d = $d . '<span class="badge badge-' . (($this->days &  64) ? 'success' : 'secondary') . '">Szo</span>';
        $d = $d . '<span class="badge badge-' . (($this->days & 128) ? 'success' : 'secondary') . '">Vas</span>';
        return $d . "</div>";
    }

    /**
     *
     */
    public function getStatusLabelAttribute() {
        if ($this->active == 1) {
            return '<span class="badge badge-success" style="cursor:pointer">Aktív</span>';
        } else {
            return '<span class="badge badge-danger" style="cursor:pointer">Inaktív</span>';
        }
    }

    // TODO if (Request::is('backend/*'))

    public function makeShowButton($namespace = 'admin')
    {
        return '<a href="'.route($namespace.'.datasets.'.$this->clazz.'.show', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'" class="btn btn-info"><i class="fas fa-eye"></i></a>';
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return $this->makeShowButton();
    }

    /**
     * @return string
     */
    public function getFrontendShowButtonAttribute()
    {
        return $this->makeShowButton('frontend');
    }

    /**
     * @return string
     */
    public function makeEditButton($namespace = 'admin')
    {
        return '<a href="'.route($namespace.'.datasets.'.$this->clazz.'.edit', $this).'" class="btn btn-success"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'"></i></a>';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return $this->makeEditButton();
    }

    /**
     * @return string
     */
    public function getFrontendEditButtonAttribute()
    {
        return $this->makeEditButton('frontend');
    }

    /**
     * @return string
     */
    public function makeDeleteButton($namespace = 'admin')
    {
        return '<a href="'.route($namespace.'.datasets.'.$this->clazz.'.destroy', $this).'"
            data-key="'.$this->id.'"
			data-method="delete"
			data-trans-button-cancel="'.__('buttons.general.cancel').'"
			data-trans-button-confirm="'.__('buttons.general.crud.delete').'"
			data-trans-title="'.__('strings.backend.general.are_you_sure').'"
			class="btn btn-danger"><i class="fas fa-trash"></i></a> ';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return $this->makeDeleteButton();
    }

    /**
     * @return string
     */
    public function getFrontendDeleteButtonAttribute()
    {
        return $this->makeDeleteButton('frontend');
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">
            '.$this->frontend_show_button.'
            '.$this->frontend_edit_button.'
            '.$this->delete_button.'
        </div>';
    }

    /**
     * @return string
     */
    public function getFrontendActionButtonsAttribute()
    {
        return '<div class="btn-group" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">
            '.$this->frontend_delete_button.'
        </div>';
    }
}
