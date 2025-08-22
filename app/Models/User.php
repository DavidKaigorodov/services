<?php

namespace App\Models;

use App\Models\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    ### Настройки
    ##################################################
    protected
    $table = 'main__users',
    $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ],
    $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    ### Методы
    ##################################################
    public function hasRole(string $role)
    {
        return user()->role_id === UserRole::where('code', $role)->get()->first()->id;
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(WorkSchedule::class, 'user_id', 'id');
    }

    ### Связи
    ##################################################
    public function role(): BelongsTo
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function services(): HasManyThrough
    {
        return $this->hasManyThrough(Service::class, UserService::class,'user_id','id','id','service_id')->withTrashed();
    }

}
