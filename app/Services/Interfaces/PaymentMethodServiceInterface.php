<?php

namespace App\Services\Interfaces;

interface PaymentMethodServiceInterface
{
    public function getPaymentMethodByCode(string $name);
}
