@extends('layouts.app', ['title' => 'Order history'])


@section('content')

    <div class="container mt-4 mb-5 col-md-10 col-xl-8 col-xxl-6">

        <div class="mb-4">
            <div class="text-white p-5 shadow-sm rounded banner-gradient">
                @if($orders->isNotEmpty())
                    <h5 class="display-6">
                        You have {{ $orderCount }}
                        @if($orderCount > 1)
                            orders
                        @else()
                            order
                        @endif
                    </h5>
                    <p class="lead">Feel free to make another one</p>
                @else
                    <h5 class="display-6">Your order list is empty</h5>
                    <p class="lead">Time to start shopping!</p>
                @endif
            </div>
        </div>

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

                            <div class="d-flex justify-content-between">
                                <div>
                                    <p>First name: {{ $order->first_name }}</p>
                                    <p>Last name: {{ $order->last_name }}</p>
                                    <p>Payment method: {{ $order->paymentMethod->name }}</p>
                                    <p>
                                        <span>Fast delivery:&nbsp;</span>
                                        <i class="fa @if($order->fast_delivery) fa-check @else fa-times @endif"></i>
                                    </p>
                                    <div>
                                        <span>Address:</span>
                                        <ul>
                                            <li>Country: {{ $order->address->country->name }}</li>
                                            <li>City: {{ $order->address->city }}</li>
                                            <li>Street: {{ $order->address->street }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div>
                                    <form action="{{ route('order.delete') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash text-white"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div>
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th>Quantity</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->products as $product)
                                        <tr>
                                            <td>{{ $product->pivot->quantity }}</td>
                                            <td>
                                                <a href="{{ route('product.details', $product->id) }}"
                                                   class="text-decoration-none text-black underline-on-hover">
                                                    {{ $product->name }}
                                                </a>
                                            </td>
                                            <td>
                                                ${{ number_format($product->pivot->quantity * $product->price, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-bold">
                                            ${{ number_format($order->getTotalPrice(), 2) }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination justify-content-center mt-4">
            {!! $orders->links() !!}
        </div>

    </div>
@endsection

@section('styles')
    <style>
        p {
            margin-bottom: 6px;
        }

        .fa-check, .fa-times {
            position: relative;
            top: 1px;
        }
    </style>
@endsection
