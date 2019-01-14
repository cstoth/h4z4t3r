<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\GeneralException;

/**
 * Class City.
 */
class City extends Model
{
    protected $table = "cities";
    protected $clazz = "city";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'kshkod',
        'irsz',
        'megye',
        'x',
        'y',
    ];

    /**
     *
     */
    // protected $attributes = [
    //     'name' => 'Településnév',
    //     'kshkod' => 'KSH kód',
    //     'irsz' => 'Irányítószám',
    //     'megye' => 'Megyenév',
    //     'x' => 'Hosszúság',
    //     'y' => 'Szélesség',
    // ];

    /**
     *
     */
    public static $rules = [
        'name'      => ['required', 'unique:cities', 'max:191'],
        'kshkod'    => ['required', 'unique:cities', 'max:10'],
        'irsz'      => ['required'],
        'megye'     => ['required'],
        'x'         => ['required'],
        'y'         => ['required'],
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
        // 'active' => 'boolean',
        // 'confirmed' => 'boolean',
    ];

    // TODO if (Request::is('backend/*'))

    public static function getCityByName($name, $exact = false) {
        $city = City::select("id")->where("name", "=", "{$name}")->first();
        if (!$city) {
            if ($exact) {
                return null;
            } else {
                $city = City::select("id")->where("name", "like", "{$name}%")->first();
                if (!$city) {
                    $city = City::select("id")->where("name", "like", "%{$name}%")->first();
                }
            }
        }
        return $city['id'];
    }

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
			 data-method="delete"
			 data-trans-button-cancel="'.__('buttons.general.cancel').'"
			 data-trans-button-confirm="'.__('buttons.general.crud.delete').'"
			 data-trans-title="'.__('strings.backend.general.are_you_sure').'"
			 class="btn btn-danger"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.delete').'"></i></a> ';
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
        return '<div class="btn-group btn-group-sm" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">
            '.$this->show_button.'
            '.$this->edit_button.'
            '.$this->delete_button.'
        </div>';
    }

    /**
     * @return string
     */
    public function getFrontendActionButtonsAttribute()
    {
        return '<div class="btn-group btn-group-sm" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">
            '.$this->frontend_show_button.'
            '.$this->frontend_edit_button.'
            '.$this->frontend_delete_button.'
        </div>';
    }

    /**
     *
     */
    public static function getCityIdByName($name) {
        $city = City::select("id")->where("name", "=", "{$name}")->first();
        if ($city) {
            return $city['id'];
        }
        throw new GeneralException("Az adott névvel nem található település: ".$name);
    }

}
