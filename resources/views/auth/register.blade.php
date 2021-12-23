@extends('layouts.app', ["title" => "Create account"])

@section('content')
    <div class="container my-auto">
        <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto bg-light rounded-3 p-5 shadow">
            <form action="{{ route('register') }}" method="post" class="needs-validation" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}"
                           class="form-control
                                @if ($errors->any() && !$errors->get('username')) is-valid
                                @elseif($errors->get('username')) is-invalid
                                @endif">
                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           class="form-control
                                    @if ($errors->any() && !$errors->get('email')) is-valid
                                    @elseif($errors->get('email')) is-invalid
                                    @endif">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password"
                           class="form-control
                                    @if ($errors->any() && !$errors->get('password')) is-valid
                                    @elseif($errors->get('password')) is-invalid
                                    @endif">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
@endsection
