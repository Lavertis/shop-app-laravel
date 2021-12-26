<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterProductsRequest;
use App\Services\ProductServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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

    public function productsFiltered(FilterProductsRequest $request): View|Factory|Application|RedirectResponse
    {
        $min = $request->get('min-price');
        $max = $request->get('max-price');

        if ($min == null && $max == null)
            return redirect('/products');

        $products = $this->productService->getProductsWithinPriceRange($min, $max);
        return view('product.products', [
            'products' => $products,
            'filters' => [
                'price' => ['min' => $min, 'max' => $max]
            ]
        ]);
    }

    public function productDetails(string $id): Factory|View|Application
    {
        $product = $this->productService->getProductById($id);
        if (!$product)
            return view('errors.404');
        else
            return view('product.product_details', ['product' => $product]);
    }
}
