<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Throwable;

class Authorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            if ($request->headers->get('api_token') && User::where('api_token', decrypt($request->headers->get('api_token')))
                    ->firstOrFail()->exists) {
                return $next($request);
            }
        } catch (Throwable $e) {
        }

        return response('Geen toestemming', 401);
    }
}
