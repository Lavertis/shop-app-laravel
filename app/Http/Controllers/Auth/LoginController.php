<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LogUserInRequest;
use App\Services\UserServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    private UserServiceInterface $userService;

    /**
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index(): Factory|View|Application
    {
        return view('auth.login');
    }

    public function logUserIn(LogUserInRequest $request): RedirectResponse
    {
        $loggedSuccessfully = $this->userService->login($request);
        if ($loggedSuccessfully)
            return redirect()->route('home');
        else
            return back()->with('status', 'Invalid login details');
    }
}
