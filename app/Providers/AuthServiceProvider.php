<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
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
        Gate::define('isAdmin',function($user) {
            return $user->role == 'admin';
        });
        Gate::define('isGuru',function($user) {
            return $user->role == 'guru';
        });
        Gate::define('isWalikelas',function($user) {
            return $user->role == 'walikelas';
        });
        Gate::define('isBk',function($user) {
            return $user->role == 'bk';
        });
        Gate::define('isKeuangan',function($user) {
            return $user->role == 'keuangan';
        });
    }
}
