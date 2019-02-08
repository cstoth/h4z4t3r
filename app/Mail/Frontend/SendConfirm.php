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
 * Class SendConfirm.
 */
class SendConfirm extends Mailable {
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * SendConfirm constructor.
     *
     * @param User $user
     */
    public function __construct(User $_user) {
        $this->user = $_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->to($this->user->email, $this->user->full_name)
            ->view('frontend.mail.confirm')
            //->text('frontend.mail.cancel-text')
            ->subject(__('mails.confirm.subject', ['app_name' => app_name(), 'route_label' => 'route_label']))
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo($this->user->email, $this->user->full_name);
    }
}
