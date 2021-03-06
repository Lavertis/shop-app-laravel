<?php

namespace App\Services\Implementations;

use App\Models\PaymentMethod;
use App\Services\Interfaces\PaymentMethodServiceInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentMethodService
 * @package App\Services
 */
class PaymentMethodService implements PaymentMethodServiceInterface
{
    public function getPaymentMethodByCode(string $name): Model|PaymentMethod|null
    {
        return PaymentMethod::whereCode($name)->first();
    }
}
