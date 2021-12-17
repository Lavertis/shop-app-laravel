<?php

namespace App\Services\Implementations;

use App\Models\Product;
use App\Services\ProductServiceInterface;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService implements ProductServiceInterface
{
    public function getAllProducts(): array
    {
        return Product::all()->toArray();
    }
}
