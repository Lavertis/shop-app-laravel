<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\HomeServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cookie;
use Psy\Util\Json;

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
        $homepageVisits = $this->homeService->handleHomepageVisits();
        $cookie = Cookie::forever('homepage_visits', Json::encode($homepageVisits));
        Cookie::queue($cookie);
        return view('home', ['visitCount' => $homepageVisits['count']]);
    }
}
