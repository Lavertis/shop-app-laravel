<?php

namespace App\Http\Controllers;

use App\Http\Requests\Basket\ChangeBasketItemRequest;
use App\Http\Requests\Basket\RemoveBasketItemRequest;
use App\Services\Interfaces\BasketServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
        return view('Basket.Basket', ['products' => $products]);
    }

    public function postAddItem(ChangeBasketItemRequest $request)
    {
        return $this->basketService->addToBasket($request);
    }

    public function patchUpdateItem(ChangeBasketItemRequest $request)
    {
        return $this->basketService->changeProductQuantity($request);
    }

    public function postDeleteItem(RemoveBasketItemRequest $request): RedirectResponse
    {
        $this->basketService->removeFromBasket($request);
        return back();
    }
}
