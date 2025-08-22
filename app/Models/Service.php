<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    /** @use HasFactory<\Database\Factories\Division\ServiceFactory> */
    use HasFactory, SoftDeletes;

    ### Настройки
    ##################################################
    protected
        $table = 'main__services',
        $fillable = [
            'name',
            'duration',
        ];

}
