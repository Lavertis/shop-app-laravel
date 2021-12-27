<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAccountDetailsRequest;
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

    public function accountDetails(): Factory|View|Application
    {
        $username = Auth::user()->username;
        $email = Auth::user()->email;
        return view('account.account_details', ['username' => $username, 'email' => $email]);
    }

    public function accountEdit(): Factory|View|Application
    {
        $username = Auth::user()->username;
        $email = Auth::user()->email;
        return view('account.account_edit', ['username' => $username, 'email' => $email]);
    }

    public function editAccount(UpdateAccountDetailsRequest $request): RedirectResponse
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

    public function deleteAccount(): Factory|View|Application
    {
        $id = Auth::user()->id;
        $this->userService->deleteUser($id);
        return view('home');
    }
}
