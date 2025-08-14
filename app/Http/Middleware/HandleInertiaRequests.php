<?php

namespace App\Http\Middleware;

use App\Http\Resources\Flash\CurrentUserResource;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        $shared = parent::share($request);

        $shared['flash'] = [];
        if ($request->session()->has('message'))
            $shared['flash']['success'] = $request->session()->get('message');

        if ($request->session()->has('error'))
            $shared['flash']['error'] = $request->session()->get('error');

        if ($request->session()->has('info'))
            $shared['flash']['info'] = $request->session()->get('info');

        if ($request->session()->has('warning'))
            $shared['flash']['warning'] = $request->session()->get('warning');

        return $shared;
    }
}
