<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $isVerified = false;
        if(Auth::user() !== null and Auth::user()->hasVerifiedEmail()){
            $isVerified = true;
        }
        return array_merge(parent::share($request), [
            'flash' => [
                'alert' => $request->session()->get('alert'),
            ],
            'auth.user' => fn () => $request->user()
                ? $request->user()->only('id', 'name', 'email', 'verified', 'bio', 'status', 'role')
                : null,
            'verified'=> $isVerified,
        ]);
    }
}
