<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\OrderCheckoutRequest;
use App\Http\Requests\Order\OrderDeleteRequest;
use App\Services\Interfaces\BasketServiceInterface;
use App\Services\Interfaces\CountryServiceInterface;
use App\Services\Interfaces\OrderServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class OrderController extends Controller
{
    private CountryServiceInterface $countryService;
    private BasketServiceInterface $basketService;
    private OrderServiceInterface $orderService;

    public function __construct(CountryServiceInterface $countryService,
                                BasketServiceInterface $basketService,
                                OrderServiceInterface  $orderService)
    {
        $this->countryService = $countryService;
        $this->basketService = $basketService;
        $this->orderService = $orderService;
        $this->middleware('auth');
    }

    public function getCheckout(): View|Factory|Application|RedirectResponse
    {
        $productsInBasketCount = $this->basketService->getProductsInBasket()->count();
        if ($productsInBasketCount === 0)
            return back();

        $countries = $this->countryService->getAllCountries();
        return view('order.checkout', ['countries' => $countries]);
    }

    public function postCheckout(OrderCheckoutRequest $request): Redirector|Application|RedirectResponse
    {
        $this->orderService->createNewOrder($request);
        return redirect('/orders/history');
    }

    public function getHistory(): Factory|View|Application
    {
        $orders = $this->orderService->getAllOrders();
        return view('order.history', ['orders' => $orders]);
    }

    public function postDelete(OrderDeleteRequest $request): Redirector|Application|RedirectResponse
    {
        $this->orderService->deleteOrder($request->order_id);
        return redirect('/orders/history');
    }
}
