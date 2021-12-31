<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\HomeServiceInterface;
use Illuminate\Support\Facades\Cookie;

/**
 * Class HomeService
 * @package App\Services
 */
class HomeService implements HomeServiceInterface
{
    public function incrementHomePageVisits(): int
    {
        $val = Cookie::get('homepage_visits');
        if (is_numeric($val))
            $val++;
        else
            $val = 1;
        return $val;
    }
}
