<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DivisionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'city' => [
                'id' => $this->city?->id,
                'name' => $this->city?->name,
            ],
            'shedules'=> $this->shedules->map(function($shedule){
                return [
                    $shedule->dayOfTheWeek->code => [
                        'date_start' => $shedule->date_start->format('H:i'),
                        'date_end' => $shedule->date_end->format('H:i'),
                    ],
                ];
            })->collapse(),
        ];
    }
}
