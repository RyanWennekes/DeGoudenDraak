<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        return User::users();
    }

    public function roles() {
        if(auth()->check()) {
            return [
                'isAdmin' => auth()->user()->role == UserRoles::Admin,
                'isCashier' => auth()->user()->role == UserRoles::Cashier,
                'isWaitress' => auth()->user()->role == UserRoles::Waitress,
                'isCustomer' => auth()->user()->role == UserRoles::Customer,
            ];
        }

        return response('Geen toestemming', 401);
    }
}
