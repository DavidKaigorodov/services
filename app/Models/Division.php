<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Division extends Model
{
    /** @use HasFactory<\Database\Factories\Admin\DivisionFactory> */
    use HasFactory;

    ### Настройки
    ##################################################
    protected
        $table = 'main__divisions';

    protected $fillable = [
        'name',
        'address',
        'city_id',
    ];

    ### Связи
    ##################################################
    /**
     * Get the user that owns the Division
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
