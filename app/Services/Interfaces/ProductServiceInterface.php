<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface ProductServiceInterface
{
    public function getAllProducts(int $productsPerPage);

    public function filterProducts(Request $request, int $productsPerPage);

    public function getProductById(string $id);
}
