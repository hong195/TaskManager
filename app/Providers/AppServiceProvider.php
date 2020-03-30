<?php

namespace App\Providers;

use App\Unit;
use App\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('manage', function (User $user, Unit $unit) {
            if ($user->getAccessLevel() <= 2) {
                if ($user->getAccessLevel() === 1) {
                    return true;
                }
                return $user->company_id === $unit->id;
            }
            return false;
        });
    }
}
