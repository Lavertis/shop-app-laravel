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
        if ($basket == null)
            Auth::user()->basket()->create()->save(); //TODO needs to be invoked twice in order to work
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

        $alreadyExists = Auth::user()->basket->products()->where('product_id', '=', $productId)->first();
        if ($alreadyExists) {
            $currentQuantity = $alreadyExists->pivot->quantity;
            Auth::user()->basket->products()
                ->where('product_id', '=', $productId)
                ->update(['quantity' => $currentQuantity + $quantity]);
        }
        else
            Auth::user()->basket->products()->attach($productId, $request->only('quantity'));
    }
}
