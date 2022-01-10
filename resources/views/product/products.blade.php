@extends('layouts.app', ['title' => 'Products'])

@section('content')
    @include('product.add_to_basket_modal')

    <div class="container-fluid mb-5">

        <div class="col-11 col-xl-9 col-xxl-7 mx-auto">

            <div class="mt-4 mb-4">
                <div class="text-white p-5 shadow-sm rounded banner-gradient">
                    <h5 class="display-6">Check out our offer</h5>
                    <p class="lead">Thousands of products with a guarantee of the highest quality</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body p-4">
                    <h5 class="card-title">Filters</h5>
                    <form action="{{ route('products.filtered') }}" method="get">
                        <div class="d-flex flex-column flex-md-row mx-auto mb-4 mb-lg-3 justify-content-between">

                            <div class="d-flex flex-column col-10 col-sm-8 col-md-6 col-lg-5 mx-auto mt-2 mb-3 mb-md-0">
                                <div class="my-auto mb-2 mb-md-0">
                                    <span>Price range</span>
                                </div>
                                <div class="d-flex flex-column flex-sm-row">
                                    <input type="number" min="0" class="form-control mb-2 mb-sm-0"
                                           id="min-price" name="min-price"
                                           @isset($filters['price']) value="{{ $filters['price']['min'] }}" @endisset>
                                    <span class="my-auto d-none d-sm-block mx-2">—</span>
                                    <input type="number" max="100000" class="form-control"
                                           id="max-price" name="max-price"
                                           @isset($filters['price']) value="{{ $filters['price']['max'] }}" @endisset>
                                </div>
                            </div>

                            <div class="d-flex flex-column col-10 col-sm-8 col-md-5 mx-auto">
                                <div class="my-auto mb-2 mb-md-0">
                                    <span>Sort by price</span>
                                </div>
                                <div class="col-md-8 col-lg-6">
                                    <select class="form-select" name="sort" id="sort">
                                        @if(isset($filters) && $filters['sort'] == 'asc')
                                            <option></option>
                                            <option value="asc" selected>Ascending</option>
                                            <option value="desc">Descending</option>
                                        @elseif(isset($filters) && $filters['sort'] == 'desc')
                                            <option></option>
                                            <option value="asc">Ascending</option>
                                            <option value="desc" selected>Descending</option>
                                        @else
                                            <option selected></option>
                                            <option value="asc">Ascending</option>
                                            <option value="desc">Descending</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div
                            class="mt-2 d-flex flex-column flex-sm-row col-12 justify-content-center justify-content-md-end">
                            <div class="mb-2 mx-auto mx-sm-1 my-sm-auto col-10 col-sm-4 col-md-auto">
                                <button class="btn btn-primary col-12">Filter</button>
                            </div>
                            <div class="mb-2 mx-auto mx-sm-1 my-sm-auto col-10 col-sm-4 col-md-auto">
                                <a href="{{ route('products') }}" class="btn btn-secondary col-12">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row m-0">
                @if($products->count())
                    @foreach($products as $product)
                        <div class="card product-card col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
                            <img class="card-img-top mt-2" alt="{{ $product->name }}"
                                 src="{{ asset('images/products/thumbnails/'.$product->id.'.jpg') }}">
                            <div class="card-body px-1 text-center">
                                <a href="{{ route('product.details', $product->id) }}"
                                   class="stretched-link text-decoration-none text-black">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                </a>
                            </div>
                            <div class="text-center mb-3 d-flex justify-content-around">
                                <h5 class="card-text my-auto col-6 col-xxl-auto">
                                    $<span class="price">{{ number_format($product->price, 2) }}</span>
                                </h5>
                                <button
                                    class="btn btn-outline-success position-relative z-index-1 col-6 col-md-3 col-xxl-3"
                                    name="add-to-basket" data-product-id="{{ $product->id }}"
                                    @guest data-bs-toggle="modal" data-bs-target="#addToBasket" @endguest>
                                    <span class="spinner-border spinner-border-sm"
                                          role="status" aria-hidden="true" hidden></span>
                                    <i class="fa fa-shopping-basket"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                    @if(isset($filters))
                        <div class="alert alert-danger text-center">
                            There are no products that meet your requirements
                        </div>
                    @else
                        <div class="alert alert-danger text-center">
                            There are no products
                        </div>
                    @endif
                @endif
            </div>

            <div class="pagination justify-content-center mt-4">
                {!! $products->links() !!}
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script>

        // Price filter input callbacks
        let minPriceInput = document.getElementById('min-price');
        let maxPriceInput = document.getElementById('max-price');

        minPriceInput.addEventListener('change', function () {
            if (this.value === "")
                return;

            if (maxPriceInput.value !== "" && parseInt(this.value) > parseInt(maxPriceInput.value))
                this.value = maxPriceInput.value
            else if (parseInt(this.value) < 0)
                this.value = 0
            else if (parseInt(this.value) > 100000)
                this.value = 100000
        })
        maxPriceInput.addEventListener('change', function () {
            if (this.value === "")
                return;

            if (minPriceInput.value !== "" && parseInt(this.value) < parseInt(minPriceInput.value))
                this.value = minPriceInput.value
            else if (parseInt(this.value) < 0)
                this.value = 0
            else if (parseInt(this.value) > 100000)
                this.value = 100000
        })

        @auth
        // Add to basket callbacks
        let buttons = document.getElementsByName('add-to-basket');
        for (const button of buttons) {
            button.addEventListener('click', async function () {
                if (this.dataset.onClickEnabled === 'false')
                    return;
                this.dataset.onClickEnabled = 'false';
                let loadingSpinner = button.getElementsByTagName('span')[0];
                let basketIcon = button.getElementsByTagName('i')[0];
                basketIcon.hidden = true;
                loadingSpinner.hidden = false;

                await sendDataAuthorized('/basket/add', {product_id: this.dataset.productId, quantity: 1})
                await sleep(500);

                loadingSpinner.hidden = true;
                basketIcon.hidden = false;
                this.dataset.onClickEnabled = 'true';
            });
        }
        @endauth
    </script>
@endsection
