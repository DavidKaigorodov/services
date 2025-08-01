<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /** @use HasFactory<\Database\Factories\Division\ServiceFactory> */
    use HasFactory;

    ### Настройки
    ##################################################
    protected
        $table = 'main__services';
}
