@extends('layouts.app', ['title' => 'Account details edit'])

@section('content')
    <div class="container my-auto">

        <!-- Vertically centered modal -->
        <div class="modal fade" id="confirmAction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="confirmActionLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmActionLabel">Confirm action</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete your account?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('account.delete') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto bg-light rounded px-5 py-4 shadow col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <h4>Edit account details</h4>
            <form class="my-4" id="edit-form" action="{{ route('account.edit') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" placeholder="{{ $username }}"
                           value="{{ old('username') }}"
                           class="form-control @if($errors->get('username')) is-invalid @endif">
                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" id="email" placeholder="{{ $email }}" value="{{ old('email') }}"
                           class="form-control @if($errors->get('email')) is-invalid @endif">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password"
                           class="form-control @if($errors->get('password')) is-invalid @endif">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>
            </form>
            <div class="d-flex flex-column flex-sm-row justify-content-sm-end mt-4">
                <button type="submit" form="edit-form" class="btn btn-success mx-sm-1 my-1 col-12 col-sm-auto">
                    Update
                </button>
                <button class="btn btn-danger mx-sm-1 my-1 col-12 col-sm-auto" data-bs-toggle="modal"
                        data-bs-target="#confirmAction">
                    Delete account
                </button>
                <a href="{{ route('account.details') }}" class="btn btn-secondary mx-sm-1 my-1 col-12 col-sm-auto">
                    Cancel
                </a>
            </div>
        </div>
    </div>
@endsection
