@extends('layouts.app')

@push('styles')
<!-- Tambahkan font Nunito -->
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Nunito', sans-serif;
    }
</style>
@endpush

@section('content')
<section class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(to bottom right, #0d47a1, #1976d2);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow border-0" style="background-color: #eef4ff;">
                    <div class="card-body p-4">
                        <h2 class="text-center text-primary fw-bold mb-4">
                            <i class="fas fa-user-circle fa-2x"></i><br>
                            Login
                        </h2>

                        {{-- ✅ Tombol Login Google Saja --}}
                        <a href="{{ url('/auth/google') }}" class="btn btn-danger w-100">
                            <i class="fab fa-google me-2"></i> Login dengan Google
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
