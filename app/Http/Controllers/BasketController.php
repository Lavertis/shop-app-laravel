<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToBasketRequest;
use App\Services\BasketServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
        $products = $this->basketService->getProductsInBasket();
        return view('basket.basket', ['products' => $products]);
    }

    public function add(AddToBasketRequest $request)
    {
        return $this->basketService->addToBasket($request);
    }

    public function delete(Request $request): RedirectResponse
    {
        $this->basketService->removeFromBasket($request);
        return back();
    }
}
