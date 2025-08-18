<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDivisionAdminRequest;
use App\Models\Division;
use App\Models\User;
use App\Models\UserRole;
use Inertia\Inertia;

class DivisionAdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Division $division)
    {
        return Inertia::render("pages/division-admins/index", [
            "users" => fn() => getResource(
                User::where('role_id', UserRole::byCode('division_admin')->id)
                    ->where('division_id', $division->id)
            ),
            'division' => $division->only('id'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Division $division)
    {
        return Inertia::render("pages/division-admins/create", [
            "users" => fn() => getResource(
                User::where('role_id', UserRole::byCode('division_worker')->id)
                    ->where('division_id', $division->id)
            ),
            "division" => fn() => getResource($division),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDivisionAdminRequest $request, Division $division)
    {
        foreach($request->ids as $id) {
            User::whereKey($id)->update(['role_id' => UserRole::byCode('division_admin')]);
        }
        return redirect()->route('division-admin.index', compact('division'))
            ->with('message','Админимстратор(ы) подразделения успешно назначен');
    }

    /**
     * Display the specified resource.
     */
    public function show(Division $division, User $user)
    {
        return Inertia::render("pages/division-admin/show", [
            'user' => fn() => getResource($user),
            "division" => fn() => getResource($division),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division, User $user)
    {
        $user->update(["role_id"=> UserRole::byCode("division_worker")]);

        return redirect()->route("division-admin.index", compact("division"));
    }
}
