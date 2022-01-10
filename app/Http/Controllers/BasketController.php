<?php

namespace App\Http\Controllers;

use App\Http\Requests\Basket\ChangeBasketItemRequest;
use App\Http\Requests\Basket\RemoveBasketItemRequest;
use App\Services\Interfaces\BasketServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Response;

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

    public function postAddItem(ChangeBasketItemRequest $request): JsonResponse
    {
        $res = $this->basketService->addToBasket($request);
        return Response::json($res);
    }

    public function patchUpdateItem(ChangeBasketItemRequest $request): JsonResponse
    {
        $res = $this->basketService->changeProductQuantity($request);
        if (!$res)
            return Response::json(['error' => 'Product with requested id not in basket'], 422);
        else
            return Response::json($res);
    }

    public function postDestroyBasket(): RedirectResponse
    {
        $this->basketService->destroyBasket();
        return back();
    }

    public function postRemoveItem(RemoveBasketItemRequest $request): RedirectResponse
    {
        $this->basketService->removeFromBasket($request);
        return back();
    }
}
