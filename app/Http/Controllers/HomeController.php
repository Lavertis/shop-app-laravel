<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\HomeServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    private HomeServiceInterface $homeService;

    /**
     * @param HomeServiceInterface $homeService
     */
    public function __construct(HomeServiceInterface $homeService)
    {
        $this->homeService = $homeService;
    }

    public function getHome(): Factory|View|Application
    {
        $visitCount = $this->homeService->incrementHomePageVisits();
        $cookie = Cookie::forever('homepage_visits', $visitCount);
        Cookie::queue($cookie);
        return view('home', ['visitCount' => $visitCount]);
    }
}
