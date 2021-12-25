@extends('layouts.app', ['title' => 'Shopping basket'])

@section('content')
    <div class="container-fluid mb-5">
        <div class="col-11 col-xl-9 col-xxl-7 mx-auto">

            <div class="my-5">
                <div class="text-white p-5 shadow-sm rounded banner-gradient">
                    @if($products->count())
                        <h5 class="display-6">You have {{ $products->count() }} item(s) in the basket</h5>
                        <p class="lead">Proceed to checkout to place the order</p>
                    @else
                        <h5 class="display-6">Your basket is empty</h5>
                        <p class="lead">Time to start shopping!</p>
                    @endif
                </div>
            </div>

            <div class="row m-0">
                @foreach($products as $product)
                    <div class="card d-flex flex-lg-row col-sm-6 col-lg-12">

                        <div class="col-lg-2 my-2">
                            <img src="{{ asset('images/products/'.$product->id.'.jpg') }}"
                                 alt="{{ $product->name }}" class="img-fluid">
                        </div>

                        <div class="card-body col-lg-10 d-flex flex-column flex-lg-row">

                            <div class="mx-auto col-lg-9 mb-4 my-lg-auto">
                                <h5 class="card-title m-0 text-center text-lg-start">
                                    <a href="{{ route('product.details', $product->id) }}"
                                       class="text-decoration-none text-black underline-on-hover">
                                        {{ $product->name }}
                                    </a>
                                </h5>
                            </div>

                            <div
                                class="col-lg-3 mt-auto my-lg-auto d-flex justify-content-around justify-content-lg-end">
                                <div class="col-6 col-lg-auto">
                                    <select class="form-select" name="quantity" id="quantity">
                                        @foreach(range(1, 9) as $i)
                                            @if($product->pivot->quantity == $i)
                                                <option value="{{ $i }}" selected>{{ $i }}</option>
                                            @else
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="px-1 col-6 col-lg-auto">
                                    <form action="{{ route('basket.delete') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <div class="d-grid">
                                            <button type="submit" class="btn bg-danger">
                                                <i class="fa fa-trash text-white"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
