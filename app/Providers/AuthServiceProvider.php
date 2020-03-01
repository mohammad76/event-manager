<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Invitation;
use App\Models\User;
use App\Policies\EventPolicy;
use App\Policies\InvitationPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
		Event::class      => EventPolicy::class,
		Invitation::class => InvitationPolicy::class,
		User::class       => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
