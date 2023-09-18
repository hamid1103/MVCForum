<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('update-post', function (User $user, Post $post){
           return ($user->id === $post->user_id) or ($user->role==='admin') or ($user->role==='mod');
        });

        Gate::define('create-post', function (){
            return Auth::user()->hasVerifiedEmail();
        });

        Gate::define('administrate', function (User $user){
            return $user->role==='admin';
        });

        /**
         * Update-Site:
         * People with this ability can create tags, edit the homepage content, create topics and categories.
         * They can also edit default site settings.
         */
        Gate::define('update-site', function (User $user){
            return $user->role==='admin' or $user->role==='mod';
        });

        Gate::define('update-server', function (User $user){
            return $user->role==='admin';
        });

        Gate::define('upload-media', function (User $user){
            return $user->hasVerifiedEmail();
        });

    }
}
