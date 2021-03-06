<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Interfaces\UserServiceInterface;
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
        $this->middleware(['guest']);
    }

    public function getLogin(): Factory|View|Application
    {
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request): RedirectResponse
    {
        $loggedInSuccessfully = $this->userService->login($request);
        if ($loggedInSuccessfully) {
            $this->userService->logoutOtherDevices($request);
            if (session()->has('url.intended'))
                return redirect()->intended();
            else
                return redirect()->route('home');
        }
        else
            return back()->withErrors(['login_details' => 'Wrong username or password']);
    }
}
