@extends('layouts.app', ["title" => "Login"])

@section('content')
    <div class="container my-auto">
        <div class="col-10 col-sm-8 col-md-6 col-lg-5 col-xl-4 mx-auto bg-light rounded-3 p-5 shadow">

            @error('login_details')
                <div class="alert alert-danger text-center">
                    {{ $message }}
                </div>
            @enderror

            <form action="{{ route('login') }}" method="post" class="needs-validation">
                @csrf

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}" required
                           class="form-control @error('username') is-invalid @enderror">
                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" required
                           class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>

            </form>
        </div>
    </div>
@endsection
