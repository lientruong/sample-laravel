<?php

namespace App\Observers;

class User {

    public function creating(\App\Models\User $user) {
        $user->email_verified_at = now();
    }
}