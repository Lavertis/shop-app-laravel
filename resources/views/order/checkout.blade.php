@extends('layouts.app', ['title' => 'Order checkout'])

@section('content')
    <div class="container my-auto py-5">
        <div class="mx-auto bg-light rounded px-5 py-4 shadow col-10 col-sm-12 col-lg-9 col-xl-8 col-xxl-7">
            <h4 class="mt-1 mb-4">Checkout</h4>

            @if($errors->any())
                <div class="alert alert-danger text-center">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form class="mb-2" action="{{ route('order.checkout') }}" method="post">
                @csrf
                <div class="input-group justify-content-between">
                    <div class="mb-3 col-12 col-sm-6 pe-sm-2">
                        <label for="first_name" class="form-label">First name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="mb-3 col-12 col-sm-6 ps-sm-2">
                        <label for="last_name" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                </div>

                <div class="input-group justify-content-between">
                    <div class="mb-3 col-12 col-sm-6 pe-sm-2">
                        <label for="country" class="form-label">Country</label>
                        <select class="form-select" id="country" name="country" required>
                            <option value="" selected disabled hidden></option>
                            @foreach($countries as $country)
                                <option value="{{ $country->code }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-12 col-sm-6 ps-sm-2">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="street" class="form-label">Street</label>
                    <input type="text" class="form-control" id="street" name="street" required>
                </div>

                <div class="input-group">
                    <div class="mb-3">
                        <label for="payment" class="form-label me-2">Payment method</label>
                        <div class="btn-group no-clicked-border" role="group"
                             aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="payment" id="visa" value="visa" required>
                            <label class="btn btn-outline-primary" for="visa">Visa</label>

                            <input type="radio" class="btn-check" name="payment" id="mastercard" value="mastercard">
                            <label class="btn btn-outline-primary" for="mastercard">MasterCard</label>

                            <input type="radio" class="btn-check" name="payment" id="transfer" value="transfer">
                            <label class="btn btn-outline-primary" for="transfer">Transfer</label>
                        </div>
                    </div>

                    <div class="my-1 mx-md-auto">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="fast_delivery" name="fast_delivery">
                            <label class="form-check-label" for="fast_delivery">Fast delivery</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-lg col-12 mt-3">Place order</button>
            </form>
        </div>
    </div>
@endsection
