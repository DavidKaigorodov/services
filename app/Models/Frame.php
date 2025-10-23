<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Division;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Frame extends Model
{
    protected
    $table = 'main__frame',
    $fillable = [
        'token',
        'division_id',
        'status_id',
    ];

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

        public function status(): BelongsTo
    {
        return $this->belongsTo(FrameStatus::class, 'status_id');
    }


}
