<?php

namespace App\Services\Interfaces;

interface ProductServiceInterface
{
    public function getAllProducts();

    public function getProductsWithinPriceRange(float $min, float $max);

    public function getProductById(string $id);
}
