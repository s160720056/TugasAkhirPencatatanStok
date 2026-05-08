<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

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
        Schema::defaultStringLength(191);
        $this->configureRateLimiting();
    }
       protected function configureRateLimiting(): void
{
    // Main limiter for User Area
    RateLimiter::for('user-area', function (Request $request) {
        $isLocal = app()->environment('local', 'testing');

        $limit = $isLocal ? 300 : 90;   // 300 in dev, 90 in production

        return Limit::perMinute($limit)
            ->by($request->user()?->id ?: $request->ip())
            ->response(function () {
                return response()->json([
                    'message' => 'Terlalu banyak permintaan. Silakan tunggu sebentar.',
                ], 429);
            });
    });

    // Tighter limiter for heavy POST actions
    RateLimiter::for('heavy-actions', function (Request $request) {
        $isLocal = app()->environment('local', 'testing');

        $limit = $isLocal ? 80 : 30;

        return Limit::perMinute($limit)
            ->by($request->user()?->id ?: $request->ip());
    });
}

}
