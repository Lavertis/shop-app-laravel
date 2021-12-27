<?php

namespace App\Services\Interfaces;

interface AddressServiceInterface
{
    public function createNewAddress(int $orderId, int $countryId, string $city, string $street);
}
