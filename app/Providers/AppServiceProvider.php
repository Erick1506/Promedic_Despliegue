<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(Request $request): void
    {
        if ($this->app->environment('production')) {
           $request->setTrustedProxies(
                [$request->getClientIp()],
                SymfonyRequest::HEADER_X_FORWARDED_FOR |
                SymfonyRequest::HEADER_X_FORWARDED_HOST |
                SymfonyRequest::HEADER_X_FORWARDED_PORT |
                SymfonyRequest::HEADER_X_FORWARDED_PROTO
            );

            URL::forceScheme('https');
        }
    }
}