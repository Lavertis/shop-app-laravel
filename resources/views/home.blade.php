@extends('layouts.app', ['title' => 'Homepage'])

@section('content')
    <div class="container my-5">

        <div class="row py-lg-5 text-center">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Computer Store</h1>
                <p class="lead text-muted">
                    We have an extremely wide offer, offer professional advice
                    and attractive prices and provide an intelligent choice.
                </p>
                <p>
                    <a href="{{ route('products') }}" class="btn btn-primary my-2">Check out our products</a>
                </p>
            </div>
        </div>

        <h1 class="text-center mt-3 mt-lg-0 mb-4">Top selling products</h1>

        <div id="carouselBestsellers" data-bs-ride="carousel"
             class="carousel carousel-dark slide col-11 col-sm-10 col-md-9 col-lg-7 col-xl-6 col-xxl-5 my-auto mx-auto">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselBestsellers" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselBestsellers" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselBestsellers" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner rounded">
                <div class="carousel-item active bg-white" data-bs-interval="10000">
                    <img src="{{ asset('images/products/423303.jpg') }}" class="d-block w-100" alt="Product 1">
                    <div class="carousel-caption d-none d-md-block">
                        <a href="{{ route('product.details', 423303) }}"
                           class="text-decoration-none text-black underline-on-hover">
                            <h5>be quiet! Dark Rock Pro 4</h5>
                        </a>
                    </div>
                </div>
                <div class="carousel-item bg-white" data-bs-interval="10000">
                    <img src="{{ asset('images/products/549089.jpg') }}" class="d-block w-100" alt="Product 2">
                    <div class="carousel-caption d-none d-md-block">
                        <a href="{{ route('product.details', 549089) }}"
                           class="text-decoration-none text-black underline-on-hover">
                            <h5>NZXT Kraken Z73 3x120mm</h5>
                        </a>
                    </div>
                </div>
                <div class="carousel-item bg-white" data-bs-interval="10000">
                    <img src="{{ asset('images/products/634238.jpg') }}" class="d-block w-100" alt="Product 3">
                    <div class="carousel-caption d-none d-md-block">
                        <a href="{{ route('product.details', 634238) }}"
                           class="text-decoration-none text-black underline-on-hover">
                            <h5> Samsung 1TB M.2 PCIe NVMe 980</h5>
                        </a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselBestsellers"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselBestsellers"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <h5 class="text-center mt-5" id="visit-count">You visited our site X times</h5>

    </div>
@endsection

@section('styles')
    <style>
        .carousel-item > img {
            margin-bottom: 30px;
        }
    </style>
@endsection
