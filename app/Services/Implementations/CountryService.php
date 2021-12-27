<?php

namespace App\Services\Implementations;

use App\Models\Country;
use App\Services\Interfaces\CountryServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CountryService
 * @package App\Services
 */
class CountryService implements CountryServiceInterface
{
    public function getAllCountries(): Collection|array
    {
        return Country::all();
    }

    public function getCountryByCode(string $code): Model|Country|null
    {
        return Country::whereCode($code)->first();
    }
}
