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

    public function getBasketItems()
    {
        return Auth::user()->basket->items;
    }

    public function addToBasket(Request $request)
    {
        return Auth::user()->basket->items()->create($request->all());
    }
}
