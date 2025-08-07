<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscribeRequest;
use App\Http\Requests\UpdateSubscribeRequest;
use App\Http\Resources\SubscribeResource;
use App\Models\Subscribe;
use Inertia\Inertia;

class SubscribeController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('pages/subscribes/index', [
            'subscribes' => fn() => getResource(Subscribe::class, SubscribeResource::class),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('pages/subscribes/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscribeRequest $request)
    {
        Subscribe::create($request->only(
            'first_name',
            'last_name',
            'middle_name',
            'phone',
            'email',
            'division_id',
            'service_id',
            'start_at'
        ));

        return redirect()->route('subscribes.index')->with('message', 'Запись успешно создана');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscribe $subscribe)
    {
        return Inertia::render('pages/subscribes/edit', [
            'subscribe' => fn() => getResource($subscribe, SubscribeResource::class),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscribeRequest $request, Subscribe $subscribe)
    {
        $subscribe->update($request->only(
            'first_name',
            'last_name',
            'middle_name',
            'phone',
            'email',
            'division_id',
            'service_id',
            'start_at'
        ));

        return redirect()->route('subscribes.index')->with('message', 'Запись успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscribe $subscribe)
    {
        $subscribe->delete();

        return redirect()->route('subscribes.index')->with('message', 'Запись удалена');
    }
}
