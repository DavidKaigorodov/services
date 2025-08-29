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
            'division' => fn() => getResource($division),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Division $division)
    {
        return Inertia::render("pages/division-admins/create", [
            "users" => fn() => getResource($division->users()),
            'division' => fn() => getResource($division),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDivisionAdminRequest $request, Division $division)
     {
        $division->users()->whereKey($request->user_id)->update([
            'role_id' => UserRole::byCode('division_admin')->id,
        ]);

        return redirect()
            ->route('division-admins.create', compact('division'))
            ->with('success', 'Админимстратор подразделения успешно назначен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division, User $division_admin)
    {
        $division_admin->update(['role_id' => UserRole::byCode('division_worker')->id]);

        return back()->with('success', 'Админимстратор подразделения удален');;
    }
}
