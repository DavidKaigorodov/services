<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /** @use HasFactory<\Database\Factories\Admin\CityFactory> */
    use HasFactory;

    ### Настройки
    ##################################################
    protected
        $table = 'main__cities',
        $fillable = [
            'name',
        ];
}
