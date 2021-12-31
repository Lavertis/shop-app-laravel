<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\FilterProductsRequest;
use App\Services\Interfaces\ProductServiceInterface;
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
    }

    public function getProducts(): Factory|View|Application
    {
        $products = $this->productService->getAllProducts(8);
        return view('product.products', ['products' => $products]);
    }

    public function getProductsFiltered(FilterProductsRequest $request): View|Factory|Application|RedirectResponse
    {
        $min = $request->get('min-price');
        $max = $request->get('max-price');
        $sort = $request->get('sort');
        $products = $this->productService->filterProducts($request, 8);

        return view('product.products', [
            'products' => $products,
            'filters' => [
                'price' => ['min' => $min, 'max' => $max],
                'sort' => $sort
            ]
        ]);
    }

    public function getProductDetails(string $id): Factory|View|Application
    {
        $product = $this->productService->getProductById($id);
        if (!$product)
            return view('errors.404');
        else
            return view('product.details', ['product' => $product]);
    }
}
