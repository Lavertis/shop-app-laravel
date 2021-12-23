@extends('layouts.app', ['title' => 'Page not found'])

@section('content')
    <div class="container-fluid my-5">
        <div class="alert alert-danger text-center col-11 col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-6 mx-auto">
            Oopsss, we did not find the page you are looking for
        </div>
    </div>
    <script>
        setTimeout(function () {
            window.location.href = "/"
        }, 10000); // 10 seconds
    </script>
@endsection
