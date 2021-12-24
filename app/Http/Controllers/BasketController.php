<?php

namespace App\Http\Controllers;

use App\Services\BasketServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    private BasketServiceInterface $basketService;

    /**
     * @param BasketServiceInterface $basketService
     */
    public function __construct(BasketServiceInterface $basketService)
    {
        $this->basketService = $basketService;
    }

    public function index(): Factory|View|Application
    {
        $userId = Auth::user()->id;
        $basketItems = $this->basketService->getBasketItems($userId);
        return view('basket.basket', ['basketItems' => $basketItems]);
    }

    public function addItem(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'quantity' => 'required'
        ]);
    }
}
