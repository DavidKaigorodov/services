<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'shedules' => ['array', 'min:0', 'max:7'],
            'shedules.*' => ['nullable', 'array'],
            'shedules.*.date_start' => ['required', 'date_format:H:i'],
            'shedules.*.date_end' => ['required', 'date_format:H:i'],
        ];
    }
}
