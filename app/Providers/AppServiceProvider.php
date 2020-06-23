<?php

namespace App\Providers;

use App\Http\Controllers\MonthCellAnalyticsController;
use App\Unit;
use App\User;
use Illuminate\Support\Carbon;
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
        $this->app->singleton(MonthCellAnalyticsController::class, function () {
            $year = request()->year ?? Carbon::parse(now())->year;
            return new MonthCellAnalyticsController($year);
        });
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
