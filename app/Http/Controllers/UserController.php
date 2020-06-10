<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        return User::create([
            'name'     => $request->get('name'),
            'role'     => $request->get('role'),
            'email'    => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ])->save() ? response('', 200) : response('Something went wrong', 500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest $request
     * @param  \App\User                            $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        return dd($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return void
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function roles()
    {
        if (auth()->check()) {
            return [
                'isAdmin'    => auth()->user()->role == UserRoles::Admin,
                'isCashier'  => auth()->user()->role == UserRoles::Cashier,
                'isWaitress' => auth()->user()->role == UserRoles::Waitress,
                'isCustomer' => auth()->user()->role == UserRoles::Customer,
            ];
        }

        return response('Geen toestemming', 401);
    }
}
