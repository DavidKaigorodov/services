<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInvite extends Model
{
    protected
        $table = 'mail__user_invites',
        $fillable = [
            'email',
            'token',
        ];
}
