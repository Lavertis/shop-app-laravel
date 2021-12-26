<?php

namespace App\Http\Controllers;

use App\Services\BasketServiceInterface;
use App\Services\CountryServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
}
