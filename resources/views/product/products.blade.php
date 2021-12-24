@extends('layouts.app', ['title' => 'Products'])

@section('content')
    <div class="container-fluid mb-5">
{{--        @csrf--}}
        <div class="col-11 col-xl-9 col-xxl-7 mx-auto">

            <div class="my-5">
                <div class="text-white p-5 shadow-sm rounded banner-gradient">
                    <h5 class="display-6">Check out our offer</h5>
                    <p class="lead">Thousands of products with a guarantee of the highest quality</p>
                </div>
            </div>

            <div class="row m-0">
                @if($products->count())
                    @foreach($products as $product)
                        <div class="card product-card col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
                            <img class="card-img-top mt-2" alt="{{ $product['name'] }}"
                                 src="{{ asset('images/products/'.$product['id'].'.jpg') }}">
                            <div class="card-body px-1 text-center">
                                <a href="{{ route('product.details', $product['id']) }}"
                                   class="stretched-link text-decoration-none text-black">
                                    <h5 class="card-title">{{ $product['name'] }}</h5>
                                </a>
                            </div>
                            <div class="text-center mb-3 d-flex justify-content-around">
                                <h5 class="card-text my-auto col-6 col-md-6">
                                    ${{ $product->getPriceAsDecimal() }}
                                </h5>
                                <button class="btn btn-outline-success position-relative z-index-1 col-6 col-md-3"
                                        name="add-to-basket" data-product-id="{{ $product['id'] }}">
                                    <i class="fa fa-shopping-basket"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-danger text-center">
                        There are no products
                    </div>
                @endif
            </div>

        </div>
    </div>
    <script>
        let buttons = document.getElementsByName('add-to-basket');
        for (const button of buttons) {
            button.addEventListener('click', function () {
                addToBasket(this.dataset.productId, 1);
            });
        }
    </script>
@endsection
