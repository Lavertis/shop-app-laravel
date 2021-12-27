<?php

namespace App\Services\Implementations;

use App\Models\Address;
use App\Services\Interfaces\AddressServiceInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AddressService
 * @package App\Services
 */
class AddressService implements AddressServiceInterface
{
    public function createNewAddress(int $orderId, int $countryId, string $city, string $street): Model|Address
    {
        return Address::create([
            'order_id' => $orderId,
            'country_id' => $countryId,
            'city' => $city,
            'street' => $street,
        ]);
    }
}
