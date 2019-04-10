<?php

namespace App\Models\Auth\Traits\Relationship;

use App\Models\System\Session;
use App\Models\Auth\SocialAccount;
use App\Models\Auth\PasswordHistory;
use App\Models\Car;
use App\Models\Advertise;
use App\Models\Messages;

/**
 * Class UserRelationship.
 */
trait UserRelationship {
    /**
     * @return mixed
     */
    public function providers() {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * @return mixed
     */
    public function sessions() {
        return $this->hasMany(Session::class);
    }

    /**
     * @return mixed
     */
    public function passwordHistories() {
        return $this->hasMany(PasswordHistory::class);
    }

    /**
     *
     */
    public function cars() {
        return $this->hasMany(Car::class)->where('status', Car::ACTIVE);
    }

    /**
     *
     */
    public function advertises() {
        return $this->hasMany(Advertise::class);
    }

    /**
     *
     */
    public function sendedMessages() {
        return $this->hasMany(Messages::class, 'from_user_id');
    }

    /**
     *
     */
    public function messages() {
        return $this->hasMany(Messages::class, 'to_user_id');
    }
}
