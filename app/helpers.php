<?php

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

if (! function_exists('user')) {
    /**
     * Возвращает текущего пользователя
     * @return User - текущий пользователь
     */
    function user(): User
    {
        $user = Auth::user() ?? new User();

        return $user;
    }
}

if (!function_exists('getResource')) {
    function getResource(string|Model|Builder $model, string $resourceClass): ResourceCollection|JsonResource
    {
        if ($model instanceof Model)
            return new $resourceClass($model);

        if ($model instanceof Builder)
            return $resourceClass::collection($model->paginate(50));

        return $resourceClass::collection($model::paginate(50));
    }
}
