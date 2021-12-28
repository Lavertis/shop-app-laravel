@extends('layouts.app', ['title' => 'Product details'])

@section('content')
    <div class="container my-5 col-11 col-md-9 col-xl-8 col-xxl-7 bg-white rounded shadow">

        <div class="mt-4 text-center">
            <h2>{{ $product->name }}</h2>
        </div>

        <div class="d-lg-flex me-lg-4">

            <div class="mt-4 col-12 col-lg-7 col-xxl-7">
                <img src="{{ asset('images/products/'.$product->id.'.jpg') }}"
                     class="img-fluid" alt="{{ $product->name }}">
            </div>

            <div class="my-auto text-center col-12 col-lg-5 col-xxl-5 border rounded-3 p-3">
                <div>
                    <h4>$<span>{{ number_format($product->price, 2) }}</span></h4>
                </div>
                <div class="d-inline-block my-2 col-8 col-sm-5 col-md-3 col-lg-auto">
                    <div class="d-grid">
                        <select class="form-select" name="quantity" id="quantity">
                            <option value="1" selected>1</option>
                            @foreach(range(2, 10) as $i)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button class="btn btn-outline-success col-8 col-sm-5 col-md-3 col-lg-auto" id="add-to-basket"
                        data-product-id="{{ $product->id }}"
                        @guest data-bs-toggle="modal" data-bs-target="#addToBasket" @endguest>
                    <span class="spinner-border spinner-border-sm"
                          role="status" aria-hidden="true" hidden></span>
                    <i class="fa fa-shopping-basket"></i>
                    Add to basket
                </button>
            </div>

        </div>
        <hr>
        <div class="container p-4 pt-1">
            <h3 class="">Description</h3>
            {{ $product->description }}
        </div>
    </div>

    <div class="modal fade" id="addToBasket" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="addToBasketLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addToBasketLabel">Not logged in</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    You must be logged in to add a product to the basket.
                </div>
                <div class="modal-footer">
                    <div class="col-10 col-sm-6 col-md-4 d-grid mx-auto">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        @auth
        // Add to basket callback
        let button = document.getElementById('add-to-basket');
        button.addEventListener('click', async function () {
            if (this.dataset.onClickEnabled === 'false')
                return;
            this.dataset.onClickEnabled = 'false';
            let loadingSpinner = button.getElementsByTagName('span')[0];
            let basketIcon = button.getElementsByTagName('i')[0];
            basketIcon.hidden = true;
            loadingSpinner.hidden = false;

            let quantity = document.getElementById('quantity').value;
            sendAddToBasketRequest(this.dataset.productId, quantity);
            await sleep(1000);

            loadingSpinner.hidden = true;
            basketIcon.hidden = false;
            this.dataset.onClickEnabled = 'true';
        });
        @endauth
    </script>
@endsection
