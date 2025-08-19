<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDivisionRequest;
use App\Http\Requests\UpdateDivisionRequest;
use App\Models\City;
use App\Models\Division;
use Inertia\Inertia;

class DivisionController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    return Inertia::render('pages/divisions/index', [
        'divisions' => fn() => getResource(Division::class),
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('pages/divisions/create', [
            'cities' => fn() => City::get(['id','name'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDivisionRequest $request)
    {
        Division::create($request->only('name', 'city_id'));

        return redirect()->route('division.index')->with('message', 'Запись успешно добавлена');
    }

    public function show(Division $division){
        return Inertia::render('pages/divisions/show', [
                'division'=> fn() => getResource($division),
                'cities' => fn() => City::get(['id','name']),
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Division $division)
    {
        return Inertia::render('pages/divisions/edit', [
            'division' => fn() => getResource($division),
            'cities' => fn() => City::get(['id','name']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDivisionRequest $request, Division $division)
    {
        $division->update($request->only('name','address', 'city_id'));

        return user()->hasRole('admin')
            ? redirect()->route('divisions.index')->with('message', 'Запись успешно изменена')
            : redirect()->route('divisions.show', compact('division'))->with('message','Запись успешно изменена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division)
    {
        $division->delete();

        return redirect()->route('division.index')->with('message', 'Запись удалена');
    }
}
