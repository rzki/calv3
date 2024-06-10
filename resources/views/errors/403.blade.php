@extends('components.layouts.error')

@section('content')
    <div class="row vh-100">
        <div class="col d-flex flex-column align-items-center justify-content-center">
            <img src="{{ asset('assets/images/403-1.png') }}" alt="" width="50%">
            <h1 class="fw-bold mb-3">{{ __('Anda tidak memiliki akses ke halaman ini!') }}</h1>
            <a href="{{ route('dashboard') }}" class="btn btn-lg btn-dark mt-4"><i class="fas fa-arrow-left "></i> {{
                __('Kembali ke Dashboard') }}</a>
        </div>
    </div>
@endsection
