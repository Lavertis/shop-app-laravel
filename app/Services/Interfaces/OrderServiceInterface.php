<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface OrderServiceInterface
{
    public function createNewOrder(Request $request);

    public function getAllOrders(int $perPage);

    public function getOrderCount();

    public function deleteOrder(int $orderId);
}
