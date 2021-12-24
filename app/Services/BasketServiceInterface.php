<?php

namespace App\Services;

use Illuminate\Http\Request;

interface BasketServiceInterface
{
    public function getBasketItems();

    public function addToBasket(Request $request);
}
