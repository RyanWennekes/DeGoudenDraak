<?php

namespace App\Http\Middleware;

use App\Enums\UserRoles;
use App\User;
use Closure;
use Throwable;

class isAdmin
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
            if ($request->headers->get('api_token')) {
                $user = User::where('api_token', decrypt($request->headers->get('api_token')))->firstOrFail();

                if ($user && $user->role == UserRoles::Admin) {
                    return $next($request);
                }
            }
        } catch (Throwable $e) {
        }

        return response('Geen toestemming', 401);
    }
}
