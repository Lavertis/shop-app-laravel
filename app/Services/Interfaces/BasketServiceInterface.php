<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface BasketServiceInterface
{
    public function getProductsInBasket();

    public function addToBasket(Request $request);

    public function changeProductQuantity(Request $request);

    public function removeFromBasket(Request $request);

    public function destroyBasket();
}
