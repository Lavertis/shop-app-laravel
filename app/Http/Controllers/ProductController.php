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
        $this->middleware('auth');
    }

    public function products(): Factory|View|Application
    {
        $products = $this->productService->getAllProducts();
        return view('product.products', ['products' => $products]);
    }

    public function productDetails(string $id): Factory|View|Application
    {
        $product = $this->productService->getProductById($id);
        if (!$product)
            return view('errors.404');
        else
            return view('product.productDetails', ['product' => $product]);
    }
}
