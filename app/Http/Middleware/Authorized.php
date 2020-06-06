<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

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
        if (User::where('api_token', decrypt($request->headers->get('api_token')))->firstOrFail()->exists) {
            return $next($request);
        }

        return response('Geen toestemming', 401);
    }
}
