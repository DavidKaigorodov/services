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
            "mon" => ['required', 'array', 'min:2', 'max:2'],
            'mon.date_start' => ['required','time'],
            'mon.date_end' => ['required','time'],

            "tue" => ['required', 'array', 'min:2', 'max:2'],
            'tue.date_start' => ['required','time'],
            'tue.date_end' => ['required','time'],

            "wed" => ['required', 'array', 'min:2', 'max:2'],
            'wed.date_start' => ['required','time'],
            'wed.date_end' => ['required','time'],

            "thu" => ['required', 'array', 'min:2', 'max:2'],
            'thu.date_start' => ['required','time'],
            'thu.date_end' => ['required','time'],

            "fri" => ['required', 'array', 'min:2', 'max:2'],
            'fri.date_start' => ['required','time'],
            'fri.date_end' => ['required','time'],

            "sat" => ['required', 'array', 'min:2', 'max:2'],
            'sat.date_start' => ['required','time'],
            'sat.date_end' => ['required','time'],

            "sun" => ['required', 'array', 'min:2', 'max:2'],
            'sun.date_start' => ['required','time'],
            'sun.date_end' => ['required','time'],
        ];
    }
}
