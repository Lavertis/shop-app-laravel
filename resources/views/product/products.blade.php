@extends('layouts.app', ['title' => 'Products'])

@section('content')
    <div class="container-fluid mb-5">
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
                                 src="{{ asset('images/products/'.$product['code'].'.jpg') }}">
                            <div class="card-body px-1 text-center">
                                <a href="{{ route('productDetails', $product['code']) }}"
                                   class="stretched-link text-decoration-none text-black">
                                    <h5 class="card-title">{{ $product['name'] }}</h5>
                                </a>
                            </div>
                            <div class="text-center mb-3">
                                <h5 class="card-text mb-3">${{ $product->getPriceAsDecimal() }}</h5>
                                <a href="#" class="btn btn-outline-success position-relative z-index-1">
                                    <i class="fa fa-shopping-cart"></i>
                                    ADD TO CART
                                </a>
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
@endsection