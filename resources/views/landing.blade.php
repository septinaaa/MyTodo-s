@extends('layouts.app')

@push('styles')
<style>
@keyframes float {
  0%   { transform: translateY(0); }
  50%  { transform: translateY(-10px); }
  100% { transform: translateY(0); }
}

.float-animation {
  animation: float 3s ease-in-out infinite;
}
</style>
@endpush

@section('content')
<section class="min-vh-100 d-flex align-items-center" style="background: linear-gradient(to right, #0d47a1, #1976d2);">
    <div class="container py-5">
        <div class="row align-items-center text-white">
            <div class="col-md-6">
                <h1 class="fw-bold display-4 mb-3 float-animation">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" style="height: 50px;"> My Todo-s App
                </h1>
                <p class="lead mb-4">“Tugas Tuntas, Hidup Terencana.”</p>

                <ul class="mb-4">
                    <li>✅ Kelola To-do dengan mudah</li>
                    <li>⏳ Mode Fokus ala Pomodoro</li>
                    <li>📅 Kalender tugas terintegrasi</li>
                    <li>📍 Lokasi tugas opsional</li>
                </ul>

                <a href="{{ route('login') }}" class="btn btn-light btn-lg shadow-sm">
                    Mulai Sekarang
                </a>
            </div>

            <div class="col-md-6 text-center mt-4 mt-md-0">
                <img src="{{ asset('img/ilustration.png') }}" alt="Ilustrasi" class="img-fluid rounded shadow float-animation">
            </div>
        </div>
    </div>
</section>
@endsection
