<?php

namespace App\Mail\Frontend;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Auth\User;
use App\Models\Advertise;
use App\Helpers\Hazater;

/**
 * Class SendMeReserve.
 */
class SendMeReserve extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * @var Advertise
     */
    public $advertise;

    /**
     * SendMeReserve constructor.
     *
     * @param User $user
     * @param Advertise $advertise
     */
    public function __construct(User $_user, Advertise $_advertise)
    {
        $this->user = $_user;
        $this->advertise = $_advertise;
        //dd($this->advertise);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->user->email, $this->user->full_name)
            ->view('frontend.mail.mereserve')
            //->text('frontend.mail.mereserve-text')
            ->subject(__('mails.mereserve.subject', ['app_name' => app_name(), 'route_label' => Hazater::routeLabel($this->advertise->id)]))
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo($this->user->email, $this->user->full_name);
    }
}
