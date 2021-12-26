<?php

namespace App\Services;

interface ProductServiceInterface
{
    public function getAllProducts();

    public function getProductsWithinPriceRange(float $min, float $max);

    public function getProductById(string $id);
}
