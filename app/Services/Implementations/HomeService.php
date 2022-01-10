<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\HomeServiceInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;

/**
 * Class HomeService
 * @package App\Services
 */
class HomeService implements HomeServiceInterface
{
    public function handleHomepageVisits(): array
    {
        $data = Cookie::get('homepage_visits');
        $data = json_decode($data, true);

        if ($data == null) {
            return [
                'count' => 1,
                'lastVisit' => Carbon::now('Europe/Warsaw')
            ];
        }

        $today = Carbon::now('Europe/Warsaw')->format('Y-m-d');
        $yesterday = Carbon::now('Europe/Warsaw')->subDay()->format('Y-m-d');
        $lastVisit = Carbon::create($data['lastVisit'])->format('Y-m-d');

        if ($lastVisit === $yesterday)
            $data['count'] += 1;
        else if ($lastVisit !== $today)
            $data['count'] = 1;

        $data['lastVisit'] = $today;

        return $data;
    }
}
