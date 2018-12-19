<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
use App\Helpers\Hazater;

class Car extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'license',
        'brand',
        'type',
        'year',
        'seats',
        'color',
        'image',
        'image2',
        'smoke',
        'cooler',
        'pet',
        'bag',
    ];

    /**
     *
     */
    // protected $attributes = [
    //     'user_id' => 'Tulajdonos',
    //     'license' => 'Rendszám',
    //     'brand' => 'Gyártmány',
    //     'type' => 'Típus',
    //     'year' => 'Évjárat',
    //     'seats' => 'Szabad ülések száma',
    //     'color' => 'Szín',
    //     'image' => 'Fotó',
    //     'smoke' => 'Dohányzó',
    //     'cooler' => 'Légkondi',
    //     'pet' => 'Háziállat',
    //     'bag' => 'Csomag',
    // ];

    /**
     *
     */
    public static $rules = [
        // 'user_id' => 'required',
        // 'license' => 'required',
        // 'seats' => 'required',
        // 'image'   => ['sometimes', 'image', 'max:191'],
        // 'image2'  => ['sometimes', 'image', 'max:191'],
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
    protected $appends = ['name',];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'smoke' => 'boolean',
        'cooler' => 'boolean',
        'pet' => 'boolean',
        'bag' => 'boolean',
        'image' => 'file',
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
     * @return string
     */
    public function getNameLabelAttribute()
    {
        return $this->license;
    }

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->license;
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
        return '<a href="'.route('admin.datasets.car.show', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'" class="btn btn-info"><i class="fas fa-eye"></i></a>';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.datasets.car.edit', $this).'" class="btn btn-success"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'"></i></a>';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.datasets.car.destroy', $this).'"
			 data-method="delete"
			 data-trans-button-cancel="'.__('buttons.general.cancel').'"
			 data-trans-button-confirm="'.__('buttons.general.crud.delete').'"
			 data-trans-title="'.__('strings.backend.general.are_you_sure').'"
			 class="btn btn-danger"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.delete').'"></i></a> ';
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
    public function getMyShowButtonAttribute()
    {
        return '<a href="'.route('frontend.datasets.car.show', $this).'"
            id="car-show-'.$this->id.'"
            data-key="'.$this->id.'"
            data-toggle="tooltip"
            data-placement="top"
            title="'.__('buttons.general.crud.view').'"
            class="btn btn-info"><i class="fas fa-eye"></i></a>';
    }

    /**
     * @return string
     */
    public function getMyEditButtonAttribute()
    {
        // href="'.route('frontend.datasets.car.edit', $this).'"
        return '<a href="'.route('frontend.datasets.car.edit', $this).'"
            id="car-edit-'.$this->id.'"
            data-key="'.$this->id.'"
            data-toggle="tooltip"
            data-placement="top"
            title="'.__('buttons.general.crud.edit').'"
            class="btn btn-success"><i class="fas fa-edit"></i></a>';
    }

    /**
     * @return string
     */
    public function getMyDeleteButtonAttribute()
    {
        if ($this->user_id == auth()->id()) {
            return '<a href="'.route('frontend.car.delete', $this).'"
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
    public function getMyActionButtonsAttribute()
    {
        return '<div id="car-buttons" class="btn-group" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">
            '.$this->my_show_button.'
            '.$this->my_edit_button.'
            '.$this->my_delete_button.'
		</div>';
    }

    public function getPictureAttribute()
    {
        return Hazater::makeUrl('storage/'.$this->image);
    }

    public function getPicture2Attribute()
    {
        return Hazater::makeUrl('storage/'.$this->image2);
    }

}
