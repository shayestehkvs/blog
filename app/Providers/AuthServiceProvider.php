<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Permission;
use http\Client\Curl\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        $this->registerPolicies();

        foreach (Permission::all() as $permission) {
            Gate::before(function ($user) {
                if ($user->isSuperUser()) return true;
            });
            Gate::define($permission->name, function ($user) use ($permission) {
               return $user->hasPermission($permission);
            });
        }
    }
}
