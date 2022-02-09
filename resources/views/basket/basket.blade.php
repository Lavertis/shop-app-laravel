@extends('layouts.app', ['title' => 'Shopping basket'])

@section('content')
    <div class="container-fluid mb-5">
        <div class="col-11 col-xl-9 col-xxl-7 mx-auto">

            <div class="my-4">
                <div class="text-white p-5 shadow-sm rounded banner-gradient">
                    @if($products->isNotEmpty())
                        <h5 class="display-6">
                            You have {{ $products->count() }}
                            @if($products->count() > 1)
                                items
                            @else()
                                item
                            @endif
                            in the basket
                        </h5>
                        <p class="lead">Proceed to checkout to place the order</p>
                    @else
                        <h5 class="display-6">Your basket is empty</h5>
                        <p class="lead">Time to start shopping!</p>
                    @endif
                </div>
            </div>

            <div class="row m-0">
                @foreach($products as $product)
                    <div class="card d-flex flex-lg-row col-sm-6 col-lg-12 basket-item">

                        <div class="col-lg-2 my-2">
                            <img src="{{ asset('images/products/thumbnails/'.$product->id.'.jpg') }}"
                                 alt="{{ $product->name }}" class="img-fluid">
                        </div>

                        <div class="card-body col-lg-10 d-flex flex-column flex-lg-row justify-content-around">

                            <div class="mx-auto col-lg-6 col-xxl-6 mb-4 my-lg-auto">
                                <h5 class="card-title m-0 text-center text-lg-start">
                                    <a href="{{ route('product.details', $product->id) }}"
                                       class="text-decoration-none text-black underline-on-hover">
                                        {{ $product->name }}
                                    </a>
                                </h5>
                            </div>

                            <div class="mt-auto mb-4 my-lg-auto mx-auto col-lg-2 col-xxl-3">
                                <h5 class="card-title m-0 text-center">
                                    $<span class="price" data-product-base-price="{{ $product->price }}"
                                    >{{ number_format($product->price * $product->pivot->quantity, 2, '.', '') }}
                                    </span>
                                </h5>
                            </div>

                            <div class="col-auto my-lg-auto d-flex">
                                <div class="input-group">
                                    <button class="btn btn-outline-dark fa fa-minus no-clicked-border"
                                            @if($product->pivot->quantity === 1) disabled @endif>
                                    </button>
                                    <input type="text" size="3" readonly
                                           value="{{ $product->pivot->quantity }}" data-product-id="{{ $product->id }}"
                                           class="form-control text-center bg-white quantity pointer-events-none">
                                    <button class="btn btn-outline-dark fa fa-plus no-clicked-border"
                                            @if($product->pivot->quantity === 99) disabled @endif>
                                    </button>
                                </div>

                                <div class="px-2 col-6 col-sm-4 col-md-6 col-lg-auto">
                                    <form action="{{ route('basket.remove_item') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash text-white"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>
                @endforeach

                @if($products->isNotEmpty())
                    <div class="card p-3 my-3">
                        <div class="col-12 ms-auto d-flex flex-column flex-sm-row justify-content-between">
                            <div class="mb-3 my-sm-auto col-12 col-sm-6 col-md-6 col-lg-auto text-center">
                                <h5 class="m-0">
                                    Total price:&nbsp;
                                    <b>$<span id="final-price"></span></b>
                                </h5>
                            </div>
                            <div
                                class="d-flex col-12 col-sm-6 col-md-6 col-lg-8 justify-content-around justify-content-sm-end">
                                <div class="mx-sm-2 col-5 col-sm-auto">
                                    <form action="{{ route('basket.destroy') }}" method="post">
                                        @csrf
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash text-white"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-5 col-sm-8 col-md-6 col-lg-3">
                                    <a class="btn btn-success col-12" href="{{ route('order.checkout') }}">
                                        Checkout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </div>
@endsection

@section('js')
    <script>
        // Calculate final price
        function calculateFinalPrice() {
            let basketItems = document.getElementsByClassName('basket-item');
            if (basketItems.length === 0)
                return;
            const finalPriceSpan = document.getElementById('final-price');
            let totalPrice = 0.0;
            for (const element of basketItems) {
                let quantityPrice = element.getElementsByClassName('price')[0];
                totalPrice += parseFloat(quantityPrice.textContent);
            }
            finalPriceSpan.textContent = totalPrice.toFixed(2);
        }

        calculateFinalPrice();

        // Add + and - button callbacks
        let basketItems = document.getElementsByClassName('basket-item');
        for (const element of basketItems) {
            let quantityPrice = element.getElementsByClassName('price')[0];
            let input = element.getElementsByClassName('quantity')[0];
            let minusButton = element.getElementsByClassName('fa-minus')[0];
            let plusButton = element.getElementsByClassName('fa-plus')[0];
            let productId = input.dataset.productId;
            let productBasePrice = quantityPrice.dataset.productBasePrice;

            minusButton.addEventListener('click', function () {
                if (input.value === '2')
                    minusButton.disabled = true;
                else if (input.value === '99')
                    plusButton.disabled = false;

                let quantity = parseInt(input.value) - 1;

                sendDataAuthorized('{{route('basket.update_item')}}', {
                    product_id: productId,
                    quantity: quantity
                }, 'PATCH');

                input.value = quantity;
                quantityPrice.textContent = (productBasePrice * quantity).toFixed(2);
                calculateFinalPrice();
            })

            plusButton.addEventListener('click', function () {
                if (input.value === '1')
                    minusButton.disabled = false;
                else if (input.value === '98')
                    plusButton.disabled = true;

                let quantity = parseInt(input.value) + 1;

                sendDataAuthorized('{{route('basket.update_item')}}', {
                    product_id: productId,
                    quantity: quantity
                }, 'PATCH');

                input.value = quantity;
                quantityPrice.textContent = (productBasePrice * quantity).toFixed(2);
                calculateFinalPrice();
            })
        }
    </script>
@endsection
