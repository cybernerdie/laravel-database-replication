<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Databases\ConnectionManager;

class LocationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $request->hasHeader('location') || ! $request->header('location')) {
            return response()->json(['error' => 'Location header is missing or empty'], 400);
        }

        $userLocation = $request->header('location');

        ConnectionManager::$userLocation = $userLocation;

        return $next($request);
    }
}
