<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout(): View|Factory|Application|RedirectResponse
    {
        $itemsInBasket = Auth::user()->basket->products->count();
        if ($itemsInBasket === 0)
            return back();
        else
            return view('order.checkout');
    }
}
