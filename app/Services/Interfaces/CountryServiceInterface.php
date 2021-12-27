<?php

namespace App\Services\Interfaces;

interface CountryServiceInterface
{
    public function getAllCountries();

    public function getCountryByCode(string $code);
}
