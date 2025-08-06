<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use App\Http\Resources\CityResource;
use Inertia\Inertia;

class CityController
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        return Inertia::render('pages/cities/index', [
            'cities' => fn() => getResource(City::class, CityResource::class),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return Inertia::render('pages/cities/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCityRequest $request){
        City::create($request->only('name'));

        return redirect()->route('cities.index')->with('message', 'Запись успешно создана');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city){
        return Inertia::render('pages/cities/edit', [
            'city' => new CityResource($city),
]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCityRequest $request, City $city){
        $city->update($request->only('name'));

        return redirect()->route('cities.index')->with('message', 'Запись успешно добавлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city){
        $city->delete();

        return redirect()->route('cities.index')->with('message', 'Запись удалена');
    }
}
