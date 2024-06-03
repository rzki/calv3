<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Gate::define('superadmin-access', function (User $users) {
            return $users->roles->code == 'superadmin';
        });

        Gate::define('admin-access', function (User $users) {
            return $users->roles->code == 'admin' || $users->roles->code == 'superadmin';
        });

        Gate::define('technician-access', function (User $users){
            return $users->roles->code == 'teknisi';
        });
    }
}
