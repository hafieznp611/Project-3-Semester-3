<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('manage-roles',fn (User $user): bool => $user->role === 'admin');
        Gate::define('reviewing',fn (User $user) => in_array($user->role, ['admin', 'reviewer']));
        Gate::define('report',fn (User $user): bool => $user->role === 'complainant');
        Gate::define('manage-distribution', fn (User $user) => in_array($user->role, ['admin', 'reviewer']));
        Gate::define('manage-master', fn (User $user) => $user->role === 'admin');

        Paginator::useBootstrapFive(); 
        }
}
