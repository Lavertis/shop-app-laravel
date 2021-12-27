<?php

namespace App\Services\Interfaces;

interface PaymentMethodServiceInterface
{
    public function getPaymentMethodByName(string $name);
}
