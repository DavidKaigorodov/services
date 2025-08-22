<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use App\Http\Resources\ServiceResource;

use Inertia\Inertia;

class ServiceController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('pages/services/index', [
            'services' => fn() => getResource(Service::class),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('pages/services/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        Service::create($request->only('name', 'duration'));

        return redirect()->route('services.index')->with('message', 'Запись успешно создана');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return Inertia::render('pages/services/edit', [
            'services' => fn() => getResource($service),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $service->update($request->only('name', 'duration'));

        return redirect()->route('services.index')->with('message', 'Запись успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')->with('message', 'Запись удалена');
    }
}
