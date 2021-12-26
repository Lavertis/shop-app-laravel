@extends('layouts.app', ['title' => 'Order checkout'])

@section('content')
    <div class="container my-auto py-5">
        <div class="mx-auto bg-light rounded px-5 py-4 shadow col-10 col-sm-12 col-lg-9 col-xl-8 col-xxl-7">
            <h4 class="mt-1">Checkout</h4>
            <form class="mt-4 mb-2">
                @csrf
                <div class="input-group justify-content-between">
                    <div class="mb-3 col-12 col-sm-6 pe-sm-2">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3 col-12 col-sm-6 ps-sm-2">
                        <label for="surname" class="form-label">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname">
                    </div>
                </div>

                <div class="input-group justify-content-between">
                    <div class="mb-3 col-12 col-sm-6 pe-sm-2">
                        <label for="country" class="form-label">Country</label>
                        <select class="form-select" id="country" name="country">
                            <option value="" selected disabled></option>
                            @foreach($countries as $country)
                                <option value="{{ $country->code }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-12 col-sm-6 ps-sm-2">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="street" class="form-label">Street</label>
                    <input type="text" class="form-control" id="street" name="street">
                </div>

                <div class="input-group">
                    <div class="mb-3">
                        <label for="payment" class="form-label me-2">Payment method</label>
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="payment" id="visa" autocomplete="off">
                            <label class="btn btn-outline-primary no-active-border" for="visa">Visa</label>

                            <input type="radio" class="btn-check" name="payment" id="mastercard" autocomplete="off">
                            <label class="btn btn-outline-primary" for="mastercard">MasterCard</label>

                            <input type="radio" class="btn-check" name="payment" id="transfer" autocomplete="off">
                            <label class="btn btn-outline-primary" for="transfer">Transfer</label>
                        </div>
                    </div>

                    <div class="my-1 mx-md-auto">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="fast-delivery" name="fast-delivery">
                            <label class="form-check-label" for="fast-delivery">Fast delivery</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-lg col-12 mt-3">Place order</button>
            </form>
        </div>
    </div>
@endsection
