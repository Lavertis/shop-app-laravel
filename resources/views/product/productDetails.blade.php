@extends('layouts.app', ['title' => 'Product details'])

@section('content')
    <div class="container my-5 col-11 col-lg-11 col-xl-9 col-xxl-7 bg-white rounded shadow">
        <div class="d-lg-flex me-lg-4">

            <div class="mt-4 col-12 col-lg-8">
                <img src="{{ asset('images/products/'.$product->id.'.jpg') }}"
                     class="img-fluid" alt="{{ $product->name }}">
            </div>

            <div class="my-auto text-center col-12 col-lg-4 border rounded-3 p-3">
                <div>
                    <h4>$<span>{{ number_format($product->price, 2) }}</span></h4>
                </div>
                <div class="d-inline-block my-2">
                    <label for="quantity">
                        <select class="form-select" name="quantity" id="quantity">
                            <option value="1" selected>1</option>
                            @foreach(range(2, 10) as $i)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <button class="btn btn-outline-success" id="add-to-basket" data-product-id="{{ $product->id }}">
                    <span class="spinner-border spinner-border-sm"
                          role="status" aria-hidden="true" hidden></span>
                    <i class="fa fa-shopping-basket"></i>
                    Add to basket
                </button>
            </div>

        </div>
        <hr>
        <div class="container p-4 pt-3">
            <h3>Description</h3>
            {{ $product->description }}
        </div>
    </div>
@endsection

@section('js')
    <script>
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
    </script>
@endsection
