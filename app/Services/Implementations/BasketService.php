<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\BasketServiceInterface;
use Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Class BasketService
 * @package App\Services
 */
class BasketService implements BasketServiceInterface
{
    private function isQuantityValid(int $quantity): bool
    {
        return $quantity >= 1 && $quantity <= 99;
    }

    private function makeSureBasketExists(): void
    {
        $basket = Auth::user()->basket;
        if ($basket == null) {
            Auth::user()->basket()->create()->save();
            Auth::user()->refresh(); // without refresh view still gets null instead of newly created Basket
        }
    }

    public function getProductsInBasket(): Collection|array|null
    {
        if (Auth::user()->basket == null)
            return Collection::empty();
        else
            return Auth::user()->basket->products;
    }

    public function addToBasket(Request $request): void
    {
        $this->makeSureBasketExists();

        $productId = $request->get('product_id');
        $product = Auth::user()->basket->products()->find($productId);
        $quantity = intval($request->get('quantity'));

        if ($product != null) {
            $currentQuantity = $product->pivot->quantity;
            if ($this->isQuantityValid($quantity + $currentQuantity)) {
                $product->pivot->quantity += $quantity;
                $product->pivot->save();
            }
        }
        else
            Auth::user()->basket->products()->attach($productId, $request->only('quantity'));
    }

    public function changeProductQuantity(Request $request): int
    {
        $productId = $request->get('product_id');
        $quantity = $request->get('quantity');
        $product = Auth::user()->basket->products()->find($productId);
        if ($this->isQuantityValid($quantity)) {
            $product->pivot->quantity = $quantity;
            $product->pivot->save();
        }

        return $product->pivot->quantity;
    }

    public function removeFromBasket(Request $request): int
    {
        if ($this->getProductsInBasket()->count() > 1) {
            $productId = $request->get('product_id');
            return Auth::user()->basket->products()->detach($productId);
        }
        else
            return $this->destroyBasket();
    }

    public function destroyBasket(): ?bool
    {
        return Auth::user()->basket->delete();
    }
}
