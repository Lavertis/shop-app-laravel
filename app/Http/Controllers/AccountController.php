<?php

namespace App\Http\Controllers;

use App\Services\UserServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    private UserServiceInterface $userService;

    /**
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
        $this->middleware('auth');
    }

    public function index(): Factory|View|Application
    {
        $username = Auth::user()->username;
        $email = Auth::user()->email;
        return view('account', ['username' => $username, 'email' => $email]);
    }

    public function deleteAccount(): Factory|View|Application
    {
        $id = Auth::user()->id;
        $this->userService->deleteUser($id);
        return view('home');
    }
}
