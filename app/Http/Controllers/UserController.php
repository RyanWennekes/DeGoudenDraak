<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;

class UserController extends Controller
{
    public function roles() {
        if(auth()->check()) {
            return [
                'isAdmin' => auth()->user()->role == UserRoles::Admin,
                'isCashier' => auth()->user()->role == UserRoles::Cashier,
                'isWaitress' => auth()->user()->role == UserRoles::Waitress,
            ];
        }

        return response('Geen toestemming', 401);
    }
}
