@extends('layouts.app')

@push('styles')
<!-- Font Nunito -->
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Nunito', sans-serif;
    }

    .landing-logo {
        display: block;
        margin: 0 auto;
        height: 120px;
        border-radius: 50%;
        animation: float 3s ease-in-out infinite;
    }

    .app-title {
        text-align: center;
        font-size: 2.8rem;
        font-weight: 700;
        margin-top: 1rem;
        color: white;
    }

    .app-description {
        text-align: center;
        font-size: 1.1rem;
        color: #e3f2fd;
        max-width: 600px;
        margin: 0 auto 1.5rem auto;
    }

    .float-image {
        animation: float 4s ease-in-out infinite;
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
</style>
@endpush

@section('content')
<section class="min-vh-100 d-flex align-items-center" style="background: linear-gradient(to right, #0d47a1, #1976d2);">
    <div class="container py-5">

        {{-- Logo & Judul --}}
        <div class="text-center mb-5">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="landing-logo">
            <h1 class="app-title">My Todo-s App</h1>
            <p class="lead text-white">“Tugas Tuntas, Hidup Terencana.”</p>
            <p class="app-description">
                Aplikasi produktivitas cerdas untuk mengelola to-do list, fokus menggunakan teknik Pomodoro,
                dan menampilkan tugas-tugas dalam tampilan kalender interaktif.
            </p>
        </div>

        <div class="row align-items-center text-white">
            <div class="col-md-6">
                <ul class="mb-4">
                    <li>✅ Kelola to-do dengan cepat dan efisien</li>
                    <li>⏳ Mode Fokus ala Pomodoro</li>
                    <li>📅 Kalender tugas yang intuitif</li>
                    <li>📍 Tambahkan lokasi atau deadline opsional</li>
                </ul>

                <a href="{{ route('login') }}" class="btn btn-light btn-lg shadow-sm">
                    Mulai Sekarang
                </a>
            </div>

            <div class="col-md-6 text-center mt-4 mt-md-0">
                <img src="{{ asset('img/ilustration.png') }}" alt="Ilustrasi" class="img-fluid rounded shadow float-image" style="background: transparent; max-height: 350px;">
            </div>
        </div>
    </div>
</section>
@endsection
