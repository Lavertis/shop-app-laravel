<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\AddressServiceInterface;
use App\Services\Interfaces\BasketServiceInterface;
use App\Services\Interfaces\CountryServiceInterface;
use App\Services\Interfaces\OrderServiceInterface;
use App\Services\Interfaces\PaymentMethodServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

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
     * @param CountryServiceInterface $countryService
     * @param PaymentMethodServiceInterface $paymentMethodService
     * @param BasketServiceInterface $basketService
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

    /**
     * @throws Throwable
     */
    public function createNewOrder(Request $request): void
    {
        DB::transaction(function () use ($request) {
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
        });
    }

    public function getAllOrders(int $perPage): LengthAwarePaginator
    {
        return Auth::user()->orders()->orderBy('order_date', 'DESC')->paginate($perPage);
    }

    public function getOrderCount(): int
    {
        return Auth::user()->orders->count();
    }

    public function deleteOrder(int $orderId)
    {
        return Auth::user()->orders()->find($orderId)->delete();
    }
}
