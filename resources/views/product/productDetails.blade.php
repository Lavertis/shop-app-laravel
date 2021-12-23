@extends('layouts.app', ['title' => 'Product details'])

@section('content')
    <div class="container my-5 col-11 col-lg-11 col-xl-9 col-xxl-7 bg-white">

        <div class="d-lg-flex me-lg-4">

            <div class="mt-4 col-12 col-lg-8">
                <img src="{{ asset('images/products/'.$product['code'].'.jpg') }}"
                     class="img-fluid" alt="{{ $product['name'] }}">
            </div>

            <div class="my-auto text-center col-12 col-lg-4 border rounded-3 p-3">
                <div>
                    <h4>${{ $product->getPriceAsDecimal() }}</h4>
                </div>
                <div class="d-inline-block my-2">
                    <label for="quantity">
                        <select class="form-select" name="quantity" id="quantity">
                            <option value="1" selected>1</option>
                            @foreach(range(2, 9) as $i)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <a href="#" class="btn btn-outline-success">
                    <i class="fa fa-shopping-cart"></i>
                    ADD TO CART
                </a>
            </div>

        </div>

        <hr>
        <div class="container p-4 pt-3">
            <h3>Description</h3>
            {{ $product['description'] }}
        </div>

    </div>
@endsection
