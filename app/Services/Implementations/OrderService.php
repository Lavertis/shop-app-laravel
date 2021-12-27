<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\AddressServiceInterface;
use App\Services\Interfaces\BasketServiceInterface;
use App\Services\Interfaces\CountryServiceInterface;
use App\Services\Interfaces\OrderServiceInterface;
use App\Services\Interfaces\PaymentMethodServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Class OrderService
 * @package App\Services
 */
class OrderService implements OrderServiceInterface
{
    private AddressServiceInterface $addressService;
    private CountryServiceInterface $countryService;
    private PaymentMethodServiceInterface $paymentMethodService;
    private BasketServiceInterface $basketService;

    /**
     * @param AddressServiceInterface $addressService
     */
    public function __construct(AddressServiceInterface       $addressService,
                                CountryServiceInterface       $countryService,
                                PaymentMethodServiceInterface $paymentMethodService,
                                BasketServiceInterface        $basketService)
    {
        $this->addressService = $addressService;
        $this->countryService = $countryService;
        $this->paymentMethodService = $paymentMethodService;
        $this->basketService = $basketService;
    }


    public function createNewOrder(Request $request): void
    {
        $countryId = $this->countryService->getCountryByCode($request->country)->id;
        $address = $this->addressService->createNewAddress($countryId, $request->city, $request->street);

        $paymentMethod = $this->paymentMethodService->getPaymentMethodByName($request->payment);
        $fastDelivery = $request->fast_delivery === 'on';

        $order = Auth::user()->orders()->create([
            'client_name' => $request->name,
            'client_surname' => $request->surname,
            'payment_method_id' => $paymentMethod->id,
            'fast_delivery' => $fastDelivery,
            'address_id' => $address->id,
            'order_date' => Carbon::now()
        ]);

        $basketItems = $this->basketService->getProductsInBasket();

        foreach ($basketItems as $basketItem) {
            $order->products()->attach($basketItem->id, ['quantity' => $basketItem->pivot->quantity]);
        }
    }
}
