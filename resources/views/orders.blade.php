@extends('layouts.app', ['title' => 'Order history'])

@section('content')
    <div class="container my-auto py-5 ">
        @foreach($orders as $order)
            <div class="border border-5 my-2">
                <p>{{ $order->order_date }}</p>
                <p>{{ $order->paymentMethod }}</p>
                <p>{{ $order->address->country }}</p>
                @foreach($order->products as $product)
                    <p>{{ $product->name }}</p>
                    <p>{{ $product->price }}</p>
                    <p>{{ $product->pivot->quantity }}</p>
                @endforeach
            </div>
            <br>
        @endforeach
    </div>
@endsection
