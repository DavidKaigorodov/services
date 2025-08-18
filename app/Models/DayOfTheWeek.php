<?php

namespace App\Models;

use App\Traits\hasCode;
use Illuminate\Database\Eloquent\Model;

class DayOfTheWeek extends Model
{
    use hasCode;

    ### Настройки
    ##################################################
    protected
        $table = 'glossary__day_of_the_week';

    public $timestamps = false;

}
