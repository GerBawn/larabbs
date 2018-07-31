<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function saving(User $user)
    {
        if (empty($user->avatar)) {
            $user->avatar = 'https://fsdhubcdn.phphub.org/uploads/images/201710/30/1/TrJS40Ey5k.png';
        }
    }
}