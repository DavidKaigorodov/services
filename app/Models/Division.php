<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    /** @use HasFactory<\Database\Factories\Admin\DivisionFactory> */
    use HasFactory;

    ### Настройки
    ##################################################
    protected
        $table = 'main__divisions';
}
