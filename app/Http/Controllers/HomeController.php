<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function getHome(): Factory|View|Application
    {
        $val = Cookie::get('homepage_visits');
        $val++;
        $cookie = Cookie::forever('homepage_visits', $val);
        Cookie::queue($cookie);
        return view('home', ['visitCount' => $val]);
    }
}
