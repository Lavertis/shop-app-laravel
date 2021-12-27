<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface ProductServiceInterface
{
    public function getAllProducts();

    public function filterProducts(Request $request);

    public function getProductById(string $id);
}
