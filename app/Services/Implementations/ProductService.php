<?php

namespace App\Services\Implementations;

use App\Models\Product;
use App\Services\Interfaces\ProductServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService implements ProductServiceInterface
{
    public function getAllProducts(int $productsPerPage): LengthAwarePaginator
    {
        return Product::paginate($productsPerPage)->appends(request()->query());
    }

    private function filterPriceRange(Request $request, Builder $products): Builder|Product
    {
        $min = $request->get('min-price');
        $max = $request->get('max-price');

        if ($min !== null && $max !== null)
            return $products->where('price', '>=', $min)->where('price', '<=', $max);
        else if ($min !== null)
            return $products->where('price', '>=', $min);
        else if ($max !== null)
            return $products->where('price', '<=', $max);
        else
            return $products;
    }

    private function sort(Request $request, Builder $products)
    {
        if ($request->get('sort') === 'asc')
            return $products->orderBy('price');
        elseif ($request->get('sort') === 'desc')
            return $products->orderByDesc('price');
        else
            return $products;
    }

    public function filterProducts(Request $request, int $productsPerPage): LengthAwarePaginator
    {
        $products = Product::query();
        $products = $this->filterPriceRange($request, $products);
        return $this->sort($request, $products)->paginate($productsPerPage)->appends(request()->query());
    }

    public function getProductById(string $id): Model|Product|null
    {
        return Product::find($id);
    }
}
