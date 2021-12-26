<?php

namespace App\Services\Implementations;

use App\Models\User;
use App\Services\UserServiceInterface;
use Illuminate\Auth\AuthenticationException;
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

    public function logout()
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

    public function changeUsername(string $newUsername)
    {
        $user = Auth::user();
        $user->username = $newUsername;
        $user->save();
        $user->refresh();
    }

    public function changeEmail(string $newEmail)
    {
        $user = Auth::user();
        $user->email = $newEmail;
        $user->save();
        $user->refresh();
    }

    public function changePassword(string $newPassword)
    {
        $user = Auth::user();
        $user->password = Hash::make($newPassword);
        $user->save();
        $user->refresh();
    }

    public function deleteUser(int $id)
    {
        $this->logout();
        User::destroy($id);
    }
}
