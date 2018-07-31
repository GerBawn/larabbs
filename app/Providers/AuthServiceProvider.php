<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Horizon\Horizon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies
        = [
            \App\Models\User::class => \App\Policies\UserPolicy::class,
            \App\Models\Topic::class => \App\Policies\TopicPolicy::class,
            \App\Models\Reply::class => \App\Policies\ReplyPolicy::class,
        ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Horizon::auth(
            function ($request) {
                return Auth::user()->hasRole('Founder');
            }
        );
        //
    }
}
