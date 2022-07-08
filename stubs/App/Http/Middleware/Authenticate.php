<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if ((bool)$request->get('route_redirect')) {
                $route_redirect = $request->get('route_redirect');
            } else {
                $route_redirect = $request->route()->getName();
            }
            if (Str::contains($route_redirect, ['login', 'register', 'password.request'])) {
                $route_redirect = null;
            }

            return route('login', ["route_redirect" => $route_redirect]);
        }
    }
}
