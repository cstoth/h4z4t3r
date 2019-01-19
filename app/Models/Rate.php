<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
use App\Models\Advertise;

class Rate extends Model
{
    protected $table = "rates";
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
        'rate',
        'comment',
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
    protected $appends = [];

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
            return '<a href="mailto:'.$this->user->email.'" target="_top">'.$this->user->full_name . " " . $this->user->phone.'</a>';
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
     * The relationship to the advertise.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advertise() {
        return $this->belongsTo(advertise::class, 'advertise_id');
    }

}
