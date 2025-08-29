<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Inertia\Inertia;

class EventCalendarController
{
    public function index(Division $division){
        return Inertia::render('pages/event-calendar/index',[
              'division' => fn() => getResource($division),
        ]);
    }
}
