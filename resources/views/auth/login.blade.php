@extends('layouts.guest')
@section('title', 'Login')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="p-4 bg-white border rounded shadow-soft border-light p-lg-5 w-100 fmxw-500">
                    <div class="mb-4 text-center text-md-center mt-md-0">
                        <h1 class="mb-3 h3">{{ __('Kalibrasi') }}</h1>
                    </div>

                    <form class="mt-4" action="{{ route('login') }}" method="POST">
                        @csrf
                        <!-- Form -->
                        <div class="mb-4 text-center form-group">
                            <label for="username">{{ __('Email / Username') }}</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input name="username" type="username" class="form-control"
                                    placeholder="{{ __('Email / Username') }}" id="username" value="{{ old('username') }}"
                                    required autofocus>
                            </div>
                            @error('username')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <!-- End of Form -->
                        <div class="form-group">
                            <!-- Form -->
                            <div class="mb-4 text-center form-group">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon2">
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                    </span>
                                    <input name="password" type="password" placeholder="{{ __('Password') }}"
                                        class="form-control" id="password" required>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                            <!-- End of Form -->
                            <div class="mb-4 d-flex justify-content-between align-items-top">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="mb-0 form-check-label" for="remember">
                                        {{ __('Remember me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-gray-800 mb-3">{{ __('Sign in') }}</button>
                        </div>

                        <div class="d-grid">
                            <a href="{{ route('devices.list') }}" class="btn btn-info" wire:navigate>{{ __('List Alat') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
