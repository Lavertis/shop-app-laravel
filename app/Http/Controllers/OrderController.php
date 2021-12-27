<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\BasketServiceInterface;
use App\Services\Interfaces\CountryServiceInterface;
use App\Services\Interfaces\OrderServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private CountryServiceInterface $countryService;
    private BasketServiceInterface $basketService;
    private OrderServiceInterface $orderService;

    public function __construct(CountryServiceInterface $countryService,
                                BasketServiceInterface  $basketService,
                                OrderServiceInterface   $orderService)
    {
        $this->countryService = $countryService;
        $this->basketService = $basketService;
        $this->orderService = $orderService;
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
        $this->orderService->createNewOrder($request);
        return $this->history();
    }

    public function history(): Factory|View|Application
    {
        $orders = Auth::user()->orders;
        return view('order.history', ['orders' => $orders]);
    }
}
