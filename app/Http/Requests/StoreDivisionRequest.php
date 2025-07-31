<?php

namespace App\Http\Requests;

use App\Models\City;
use Illuminate\Foundation\Http\FormRequest;

class StoreDivisionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'city_id' => ['required', 'exists:' . City::class . ',id']
        ];
    }
}
