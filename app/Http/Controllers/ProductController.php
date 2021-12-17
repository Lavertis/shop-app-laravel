<?php

namespace App\Http\Controllers;

use App\Services\ProductServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    private ProductServiceInterface $productService;

    /**
     * @param ProductServiceInterface $productService
     */
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function index(): Factory|View|Application
    {
        $products = $this->productService->getAllProducts();
        return view('products', ['products' => $products]);
    }
}
