<?php

namespace App\Services\Implementations;

use App\Models\Country;
use App\Services\CountryServiceInterface;
use Illuminate\Database\Eloquent\Collection;

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
}
