<?php

namespace App\Services\Implementations;

use App\Models\User;
use App\Services\UserServiceInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    public function saveUser(Request $request): User
    {
        return User::create([
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);
    }

    public function login(Request $request): bool
    {
        return auth()->attempt($request->only('username', 'password'), $request->get('remember'));
    }

    public function logout()
    {
        auth()->logout();
        session()->flush();
    }

    /**
     * @throws AuthenticationException
     */
    public function logoutOtherDevices(Request $request): User|bool|null
    {
        return Auth::logoutOtherDevices($request->get('password'));
    }
}
