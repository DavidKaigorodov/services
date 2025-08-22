<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Jobs\SendInviteJob;
use App\Models\DayOfTheWeek;
use App\Models\Division;
use App\Models\User;
use App\Models\UserRole;
use Inertia\Inertia;

class WorkerController
{
    /**
     * Display a listing of the resource.s
     */
    public function index(Division $division)
    {
        return Inertia::render("pages/workers/index", [
            "users" => fn() => getResource(
                User::where("role_id", UserRole::byCode("division_worker")->id)
                    ->where("division_id", $division->id)
            ),
            "division" => fn() => getResource($division),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Division $division)
    {
        return Inertia::render(
            "pages/workers/create",
            [
                "division" => fn() => getResource($division)
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkerRequest $request, Division $division)
    {
        SendInviteJob::dispatch();
        return redirect()->route("workers.index", compact("division"))
            ->with("message", "Приглашение успешно отправлено");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Division $division, User $worker)
    {
        return Inertia::render("pages/workers/edit", [
            "worker" => fn() => getResource($worker),
            "division" => fn() => getResource($division),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkerRequest $request, Division $division, User $worker)
    {
        $worker->schedules()->delete();

        foreach ($request->all() as $day => $dates) {
            $worker->schedules()->create([
                'day_of_the_week_id' => DayOfTheWeek::byCode($day)->id,
                'date_start' => $dates['date_start'],
                'date_end' => $dates['date_end']
            ]);
        }

        return redirect()->route('workers.index', compact('division'))->with('message', 'Рассписание обновлено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division, User $worker)
    {
        $worker->delete();
        return redirect()->route('workers.index', ['division' => $division])->with('message',value: 'Пользователь удален');
    }
}
