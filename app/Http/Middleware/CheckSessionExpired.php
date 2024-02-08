<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Event;
use App\Events\SessionExpired;
use Illuminate\Http\Request;

class CheckSessionExpired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
{
    $response = $next($request);

    if (session('username') && session('password') && !auth()->check()) {
        // Panggil fungsi logout dari LoginController
        app(\App\Http\Controllers\LoginController::class)->logout();
    }

    return $response;
}
}
