<?php

namespace App\Services\Implementations;

use App\Services\BasketServiceInterface;
use Auth;
use Illuminate\Http\Request;

/**
 * Class BasketService
 * @package App\Services
 */
class BasketService implements BasketServiceInterface
{
    private function makeSureBasketExists()
    {
        $basket = Auth::user()->basket;
        if ($basket == null) {
            Auth::user()->basket()->create()->save();
            Auth::user()->refresh(); // without refresh view still gets null instead of newly created basket
        }
    }

    public function getProductsInBasket()
    {
        $this->makeSureBasketExists();
        return Auth::user()->basket->products;
    }

    public function addToBasket(Request $request)
    {
        $this->makeSureBasketExists();

        $productId = $request->get('product_id');
        $quantity = $request->get('quantity');
        $product = Auth::user()->basket->products()->find($productId);

        if ($product != null) {
            $product->pivot->quantity += $quantity;
            $product->pivot->save();
        }
        else
            Auth::user()->basket->products()->attach($productId, $request->only('quantity'));
    }

    public function removeFromBasket(Request $request): int
    {
        $productId = $request->get('product_id');
        return Auth::user()->basket->products()->detach($productId);
    }
}
