<?php

namespace App\Services\Implementations;

use App\Models\User;
use App\Services\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    public function saveUser(Request $request)
    {
        User::create([
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);
    }

    public function login(Request $request)
    {
        auth()->attempt($request->only('username', 'password'));
    }
}
