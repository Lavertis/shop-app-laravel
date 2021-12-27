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
        $paymentMethod = $this->paymentMethodService->getPaymentMethodByCode($request->payment);
        $fastDelivery = $request->fast_delivery === 'on';

        $order = Auth::user()->orders()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'payment_method_id' => $paymentMethod->id,
            'fast_delivery' => $fastDelivery,
            'order_date' => Carbon::now('Europe/Warsaw')
        ]);

        $countryId = $this->countryService->getCountryByCode($request->country)->id;
        $this->addressService->createNewAddress($order->id, $countryId, $request->city, $request->street);

        $basketItems = $this->basketService->getProductsInBasket();
        foreach ($basketItems as $basketItem) {
            $order->products()->attach($basketItem->id, ['quantity' => $basketItem->pivot->quantity]);
        }

        $this->basketService->destroyBasket();
    }
}
