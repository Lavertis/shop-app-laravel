<?php

namespace App\Services;

use Illuminate\Http\Request;

interface UserServiceInterface
{
    public function saveUser(Request $request);

    public function login(Request $request);

    public function logout();

    public function logoutOtherDevices(Request $request);

    public function changeUsername(string $newUsername);

    public function changeEmail(string $newEmail);

    public function changePassword(string $newPassword);

    public function deleteUser(int $id);
}
