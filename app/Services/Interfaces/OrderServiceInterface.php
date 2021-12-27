<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface OrderServiceInterface
{
    public function createNewOrder(Request $request);

    public function getAllOrders();

    public function deleteOrder(int $orderId);
}
