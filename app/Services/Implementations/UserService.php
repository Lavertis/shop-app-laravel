<?php

namespace App\Services\Implementations;

use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
        return Auth::attempt($request->only('username', 'password'), $request->get('remember'));
    }

    public function logout(): void
    {
        Auth::logout();
        Session::flush();
    }

    /**
     * @throws AuthenticationException
     */
    public function logoutOtherDevices(Request $request): User|bool|null
    {
        return Auth::logoutOtherDevices($request->get('password'));
    }

    public function changeUsername(string $newUsername): User|Authenticatable|null
    {
        $user = Auth::user();
        $user->username = $newUsername;
        $user->save();
        return $user->refresh();
    }

    public function changeEmail(string $newEmail): User|Authenticatable|null
    {
        $user = Auth::user();
        $user->email = $newEmail;
        $user->save();
        return $user->refresh();
    }

    public function changePassword(string $newPassword): User|Authenticatable|null
    {
        $user = Auth::user();
        $user->password = Hash::make($newPassword);
        $user->save();
        return $user->refresh();
    }

    public function deleteUser(int $id): int
    {
        $this->logout();
        return User::destroy($id);
    }
}
