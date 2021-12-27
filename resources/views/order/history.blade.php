@extends('layouts.app', ['title' => 'Order history'])

@section('content')
    <div class="container my-auto py-5 ">

        <div class="accordion" id="order-accordion">
            @foreach($orders as $order)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $loop->index }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                aria-expanded="false" data-bs-target="#collapse{{ $loop->index }}"
                                aria-controls="collapse{{ $loop->index }}">
                            {{ $order->order_date }}
                        </button>
                    </h2>
                    <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse"
                         aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#order-accordion">
                        <div class="accordion-body">
                            <p>First name: {{ $order->first_name }}</p>
                            <p>Last name: {{ $order->last_name }}</p>
                            <p>Payment method: {{ $order->paymentMethod->name }}</p>
                            <p>
                                Fast delivery:&nbsp;&nbsp;
                                <i class="fa @if($order->fast_delivery) fa-check @else fa-times @endif"></i>
                            </p>
                            <div>
                                Address:
                                <ul>
                                    <li>Country: {{ $order->address->country->name }}</li>
                                    <li>City: {{ $order->address->city }}</li>
                                    <li>Street: {{ $order->address->street }}</li>
                                </ul>
                            </div>
                            <div>
                                Products:
                                <ul>
                                    @foreach($order->products as $product)
                                        <li>
                                            {{ $product->pivot->quantity }}x
                                            {{ $product->name }}
                                            -
                                            ${{ number_format($product->pivot->quantity * $product->price, 2) }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
