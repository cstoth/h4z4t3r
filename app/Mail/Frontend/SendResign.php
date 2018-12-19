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
 * Class SendResign.
 */
class SendResign extends Mailable
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
     * SendResign constructor.
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
            ->view('frontend.mail.resign')
            ->text('frontend.mail.resign-text')
            ->subject(__('strings.emails.resign.subject', ['app_name' => app_name(), 'route_label' => Hazater::routeLabel($this->advertise->id)]))
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo($this->user->email, $this->user->full_name);
    }
}
