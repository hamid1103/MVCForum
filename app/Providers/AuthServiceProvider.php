<?php

namespace App\Providers;
use Silber\Bouncer\Bouncer;

// use Illuminate\Support\Facades\Gate;
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
        //Allow Admin stuff
        Bouncer::allow('admin')->everything();

        //Allow Moderator stuff
        Bouncer::allow('mod')->to('createTopic');
        Bouncer::allow('mod')->to('createPost');

        //Allow user stuff
        Bouncer::allow('reply')->to('createPost');
    }
}
