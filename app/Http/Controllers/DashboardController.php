<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Inertia\Inertia;

class DashboardController
{
    public function index(Division $division){
        return Inertia::render('pages/dashboard/index',[
              'division' => fn() => getResource($division),
        ]);
    }
}
