<?php

namespace App\Http\Controllers;

use App\Services\BasketServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    private BasketServiceInterface $basketService;

    /**
     * @param BasketServiceInterface $basketService
     */
    public function __construct(BasketServiceInterface $basketService)
    {
        $this->basketService = $basketService;
        $this->middleware('auth');
    }

    public function index(): Factory|View|Application
    {
        $basketItems = $this->basketService->getBasketItems();
        return view('basket.basket', ['basketItems' => $basketItems]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'quantity' => ['required', 'min:1', 'max:9']
        ]);

        return $this->basketService->addToBasket($request);
    }
}
