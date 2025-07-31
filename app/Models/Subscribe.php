<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    /** @use HasFactory<\Database\Factories\User\SubscribeFactory> */
    use HasFactory;

    ### Настройки
    ##################################################
    protected
        $table = 'main__subscribes';
}
