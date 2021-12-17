<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

interface UserServiceInterface
{
    public function saveUser(Request $request): User;

    public function login(Request $request): bool;
}
