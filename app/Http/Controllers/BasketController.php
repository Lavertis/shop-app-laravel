<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddOrUpdateBasketItemRequest;
use App\Services\Interfaces\BasketServiceInterface;
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

    public function getBasket(): Factory|View|Application
    {
        $products = $this->basketService->getProductsInBasket();
        return view('basket.basket', ['products' => $products]);
    }

    public function postAddItem(AddOrUpdateBasketItemRequest $request)
    {
        return $this->basketService->addToBasket($request);
    }

    public function patchUpdateItem(AddOrUpdateBasketItemRequest $request)
    {
        return $this->basketService->changeProductQuantity($request);
    }

    public function postDeleteItem(Request $request): RedirectResponse
    {
        $this->basketService->removeFromBasket($request);
        return back();
    }
}
