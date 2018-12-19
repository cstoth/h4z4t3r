<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;

class Messages extends Model  {

    protected $table = 'messages';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'readed' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'advertise_id',
        'subject',
        'message',
        'readed',
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at'];

    /**
     *
     */
    public static $rules = [
        // 'to_user_id' => 'required',
        // 'subject' => 'required',
        // 'message' => 'required',
    ];

    /**
     * The relationship to the from-user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    /**
     * The relationship to the to-user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

        /**
     * The relationship to the to-user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advertise()
    {
        return $this->belongsTo(Advertise::class, 'advertise_id');
    }

    /**
     * @return bool
     */
    public function isReaded()
    {
        return $this->readed;
    }

    public function getBoolItem($bool) {
        if ($bool) {
            return '<span class="badge badge-success" style="cursor:pointer">Olvasva</span>';
        } else {
            return '<span class="badge badge-danger" style="cursor:pointer">Olvasatlan</span>';
        }
    }

    /**
     * @return string
     */
    public function getReadedLabelAttribute()
    {
        if ($this->isReaded()) {
            // return "<span class='badge badge-info'>".__('labels.frontend.message.readed').'</span>';
            return "<img id='message-view-".$this->id."' data-key='".$this->id."' src='".asset("img/frontend/hazater.msg.open.png")."' width='30px' height='30px' title=".__('labels.frontend.message.readed')." />";
        }

        // return "<span class='badge badge-danger'>".__('labels.frontend.message.unread').'</span>';
        return "<img id='message-view-".$this->id."' data-key='".$this->id."' src='".asset("img/frontend/hazater.msg.closed.png")."' width='30px' height='30px' title='".__('labels.frontend.message.unread')."'/>";
    }

    /**
     * @return string
     */
    public function getFromUserLabelAttribute()
    {
        return $this->fromUser->full_name;
    }

    /**
     * @return string
     */
    public function getToUserLabelAttribute()
    {
        return $this->toUser->full_name;
    }

    /**
     * @return string
     */
    public function getAdvertiseLabelAttribute()
    {
        return isset($this->advertise) ? $this->advertise->route_label : "";
    }

    // /**
    //  * @return string
    //  */
    // public function getShowButtonAttribute()
    // {
    //     return '<a href="'.route('frontend.datasets.message.show', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'" class="btn btn-info"><i class="fas fa-eye"></i></a>';
    // }

    // /**
    //  * @return string
    //  */
    // public function getEditButtonAttribute()
    // {
    //     return '<a href="'.route('frontend.datasets.message.edit', $this).'" class="btn btn-success"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'"></i></a>';
    // }

    // /**
    //  * @return string
    //  */
    // public function getDeleteButtonAttribute()
    // {
    //     return '<a href="'.route('frontend.datasets.message.destroy', $this).'"
	// 		 data-method="delete"
	// 		 data-trans-button-cancel="'.__('buttons.general.cancel').'"
	// 		 data-trans-button-confirm="'.__('buttons.general.crud.delete').'"
	// 		 data-trans-title="'.__('strings.backend.general.are_you_sure').'"
	// 		 class="btn btn-danger"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.delete').'"></i></a> ';
    // }

    // /**
    //  * @return string
    //  */
    // public function getActionButtonsAttribute()
    // {
    //     return '<div class="btn-group btn-group-sm" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">
	// 		  '.$this->show_button.'
	// 		</div>';
    // }











    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        // '.$this->delete_button.'
        // data-advertise="'.$this->advertise->route_label.'"
        return '<a
            id="message-show-'.$this->id.'"
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
        // href="'.route('admin.auth.user.edit', $this).'"
        return '<a
            id="message-edit-'.$this->id.'"
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
            return '<a href="'.route('frontend.messages.delete', $this).'"
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
        return '<div id="message-buttons" class="btn-group" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">
            '.$this->show_button.'
		</div>';
    }

}
