<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Country;
use App\Models\PaymentMethod;
use App\Services\BasketServiceInterface;
use App\Services\CountryServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private CountryServiceInterface $countryService;
    private BasketServiceInterface $basketService;

    public function __construct(CountryServiceInterface $countryService, BasketServiceInterface $basketService)
    {
        $this->countryService = $countryService;
        $this->basketService = $basketService;
        $this->middleware('auth');
    }

    public function checkout(): View|Factory|Application|RedirectResponse
    {
        $productsInBasketCount = $this->basketService->getProductsInBasket()->count();
        if ($productsInBasketCount === 0)
            return back();

        $countries = $this->countryService->getAllCountries();
        return view('order.checkout', ['countries' => $countries]);
    }

    public function placeOrder(Request $request): Factory|View|Application
    {
        $country = Country::whereCode($request->get('country'))->get()[0];
        $address = Address::create([
            'country_id' => $country->id,
            'city' => $request->get('city'),
            'street' => $request->get('street'),
        ]);

        $paymentMethod = PaymentMethod::whereName($request->get('payment'))->get()[0];
        $fastDelivery = $request->get('fast_delivery') === 'on';

        $order = Auth::user()->orders()->create([
            'client_name' => $request->get('name'),
            'client_surname' => $request->get('surname'),
            'payment_method_id' => $paymentMethod->id,
            'fast_delivery' => $fastDelivery,
            'address_id' => $address->getAttribute('id'),
            'order_date' => Carbon::now('Europe/Warsaw')
        ]);

        $basketItems = Auth::user()->basket->products;

        foreach ($basketItems as $basketItem) {
            $order->products()->attach($basketItem->id, ['quantity' => $basketItem->pivot->quantity]);
        }

        return view('home');
    }

    public function history()
    {
        $orders = Auth::user()->orders;
        return view('orders', ['orders' => $orders]);
    }
}
