<?php

namespace App\Services\Implementations;

use App\Models\User;
use App\Services\BasketServiceInterface;

/**
 * Class BasketService
 * @package App\Services
 */
class BasketService implements BasketServiceInterface
{

    public function getBasketItems(int $id)
    {
        $user = User::whereId($id)->first();
        $basket = $user->basket;
        $items = $basket->items;
        return $items;
    }
}
