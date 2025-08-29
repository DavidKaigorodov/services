<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Http\Resources\WorkerResource;
use App\Jobs\SendInviteJob;
use App\Models\DayOfTheWeek;
use App\Models\Division;
use App\Models\Service;
use App\Models\User;
use App\Models\UserInvite;
use App\Models\UserRole;
use App\Models\UserService;
use Hash;
use Illuminate\Support\Facades\Auth;
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
    public function create(string $token)
    {
        $invite = UserInvite::where('token', $token)->first();

        if ($invite === null)
            return abort(404);

        return Inertia::render("pages/workers/create", [
            "invite" => fn() => getResource($invite),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkerRequest $request)
    {
        $invite = UserInvite::where('token', $request->input('token'))->first();

        if ($invite === null)
            return abort(404);

        $user = User::create([
            'name' => $request->string('name')->trim(),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => UserRole::byCode('division_worker')->id,
            'division_id' => $invite->division->id,
        ]);

        Auth::login($user);

        return redirect()->route('events.index', ['division' => $user->division->id]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $worker)
    {
        return Inertia::render("pages/workers/edit", [
            "worker" => fn() => WorkerResource::make($worker),
            'services' => fn() => getResource(Service::class),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkerRequest $request, User $worker)
    {
        UserService::where('user_id', $worker->id)->delete();
        foreach ($request->input('service_ids') as $service_id) {
            UserService::create([
                'user_id' => $worker->id,
                'service_id' => $service_id,
            ]);
        }


        $worker->shedules()->delete();
        foreach ($request->input('shedules') as $day => $dates) {
            $worker->shedules()->create([
                'day_of_the_week_id' => DayOfTheWeek::byCode($day)->id,
                'date_start' => $dates['date_start'],
                'date_end' => $dates['date_end']
            ]);
        }

        return redirect()
            ->route('workers.index', ['division' => $worker->division->id])
            ->with('success', 'Рассписание обновлено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division, User $worker)
    {
        $worker->delete();
        return redirect()->route('workers.index', ['division' => $division])->with('success', value: 'Пользователь удален');
    }
}
