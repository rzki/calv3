@extends('components.layouts.error')

@section('content')
    <div class="row vh-100">
        <div class="col d-flex flex-column align-items-center justify-content-center">
            <img src="{{ asset('assets/images/404-3.png') }}" alt="" width="35%">
            <h1 class="fw-bold mb-3">{{ __('Halaman Tidak Ditemukan!') }}</h1>
            <a href="{{ route('dashboard') }}" class="btn btn-lg btn-dark mt-4"><i class="fas fa-arrow-left "></i> {{
                __('Kembali ke Dashboard') }}</a>
        </div>
    </div>
@endsection
