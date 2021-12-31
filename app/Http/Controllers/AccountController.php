<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\EditAccountRequest;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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

    public function getAccountDetails(): Factory|View|Application
    {
        $username = Auth::user()->username;
        $email = Auth::user()->email;
        return view('account.details', ['username' => $username, 'email' => $email]);
    }

    public function getAccountEdit(): Factory|View|Application
    {
        $username = Auth::user()->username;
        $email = Auth::user()->email;
        return view('account.edit', ['username' => $username, 'email' => $email]);
    }

    public function postAccountEdit(EditAccountRequest $request): RedirectResponse
    {
        $username = $request->get('username');
        $email = $request->get('email');
        $password = $request->get('password');

        if ($username != null)
            $this->userService->changeUsername($username);
        if ($email != null)
            $this->userService->changeEmail($email);
        if ($password != null)
            $this->userService->changePassword($password);

        return redirect()->route('account.details');
    }

    public function postAccountDelete(): RedirectResponse
    {
        $id = Auth::user()->id;
        $this->userService->deleteUser($id);
        return redirect()->route('home');
    }
}
