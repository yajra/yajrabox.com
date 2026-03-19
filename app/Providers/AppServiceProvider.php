<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Http::macro('github', function () {
            $token = config('services.github.token');

            return Http::withToken(is_string($token) ? $token : '')
                ->baseUrl('https://api.github.com')
                ->withHeaders([
                    'Accept' => 'application/vnd.github.v3+json',
                ]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
