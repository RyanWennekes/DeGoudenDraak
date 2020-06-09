<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Str;

class ApiTokenController extends Controller
{
    public function update(User $user)
    {
        $token = Str::random(60);

        $user->forceFill([
            'api_token' => $token,
        ])->save();

        return ['token' => $token];
    }

    public function show()
    {
        if (auth()->check()) {
            return encrypt($this->update(auth()->user())['token']);
        }

        return null;
    }
}
