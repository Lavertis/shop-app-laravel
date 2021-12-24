<?php

namespace App\Services;

use Illuminate\Http\Request;

interface BasketServiceInterface
{
    public function getProductsInBasket();

    public function addToBasket(Request $request);
}
