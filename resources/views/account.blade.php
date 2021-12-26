@extends('layouts.app', ['title' => 'Account'])

@section('content')
    <div class="container my-auto">
        <div class="mx-auto bg-light rounded px-5 py-4 shadow col-11 col-sm-10 col-md-7 col-lg-6 col-xl-5 col-xxl-4">
            <div class="mx-auto">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input name="username" id="username" value="{{ $username }}" disabled
                           class="form-control pointer-events-none">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input name="email" id="email" value="{{ $email }}" disabled
                           class="form-control pointer-events-none">
                </div>
            </div>
            <div class="d-flex justify-content-end mt-4">
                <form action="{{ route('account.delete') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete account</button>
                </form>
            </div>
        </div>
    </div>
@endsection
