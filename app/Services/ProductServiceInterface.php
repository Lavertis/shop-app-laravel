<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

interface ProductServiceInterface
{
    public function getAllProducts(): Collection|array;
}
