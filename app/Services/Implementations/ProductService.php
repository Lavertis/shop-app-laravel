<?php

namespace App\Services\Implementations;

use App\Models\Product;
use App\Services\Interfaces\ProductServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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

    public function getProductsWithinPriceRange(?float $min, ?float $max): Collection|array
    {
        if ($min === null)
            return Product::where('price', '<=', $max)->get();
        else if ($max === null)
            return Product::where('price', '>=', $min)->get();
        else
            return Product::where('price', '>=', $min)->where('price', '<=', $max)->get();
    }

    public function getProductById(string $id): Model|Product|null
    {
        return Product::find($id);
    }
}
