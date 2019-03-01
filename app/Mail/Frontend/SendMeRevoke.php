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
 * Class SendMeRevoke.
 */
class SendMeRevoke extends Mailable {
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
     * SendMeRevoke constructor.
     *
     * @param User $user
     * @param Advertise $advertise
     */
    public function __construct(User $_user, Advertise $_advertise) {
        $this->user = $_user;
        $this->advertise = $_advertise;
        //dd($this->advertise);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        \Log::info('SendMeRevoke.build()' . $this->user->full_name . ' ' . $this->user->email);
        return $this->to($this->user->email, $this->user->full_name)
            ->view('frontend.mail.merevoke')
            //->text('frontend.mail.merevoke-text')
            ->subject(__('mails.merevoke.subject', ['app_name' => app_name(), 'route_label' => Hazater::routeLabel($this->advertise->id)]))
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo($this->user->email, $this->user->full_name);
    }
}
