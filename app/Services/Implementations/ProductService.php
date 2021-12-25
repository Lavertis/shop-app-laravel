<?php

namespace App\Services\Implementations;

use App\Models\Product;
use App\Services\ProductServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService implements ProductServiceInterface
{
    public function getAllProducts(): Collection|array
    {
        return Product::all();
    }

    public function getProductById(string $id): Product|null
    {
        return Product::find($id);
    }
}
