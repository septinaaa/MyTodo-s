@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Nunito', sans-serif;
    }

    .dashboard-card {
        border-radius: 16px;
        background-color: #eef4ff;
    }

    .progress {
        height: 10px;
    }

    .dashboard-icon {
        font-size: 2rem;
        color: #0d47a1;
    }
</style>
@endpush

@section('content')
<section class="min-vh-100 py-5" style="background: linear-gradient(to bottom right, #0d47a1, #1976d2);">
    <div class="container text-white mb-4">
        <h2 class="fw-bold">📊 Dashboard</h2>
        <p class="mb-0">Selamat datang, <strong>{{ Auth::user()->name }}</strong>! Berikut ringkasan to-do Anda:</p>
    </div>

    <div class="container">
        <div class="row g-4">

            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="card dashboard-card shadow border-0 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-0 fw-bold text-primary">Tugas Belum Dikerjakan</h5>
                            <p class="mb-1">Total: {{ $todoCount ?? 0 }}</p>
                        </div>
                        <i class="fas fa-tasks dashboard-icon"></i>
                    </div>
                    <div class="progress bg-light">
                        <div class="progress-bar bg-primary" style="width: {{ $todoProgress ?? 0 }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="card dashboard-card shadow border-0 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-0 fw-bold text-warning">Tugas Sedang Dikerjakan</h5>
                            <p class="mb-1">Total: {{ $inProgressCount ?? 0 }}</p>
                        </div>
                        <i class="fas fa-hourglass-half dashboard-icon text-warning"></i>
                    </div>
                    <div class="progress bg-light">
                        <div class="progress-bar bg-warning" style="width: {{ $inProgressProgress ?? 0 }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="card dashboard-card shadow border-0 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-0 fw-bold text-success">Tugas Selesai</h5>
                            <p class="mb-1">Total: {{ $doneCount ?? 0 }}</p>
                        </div>
                        <i class="fas fa-check-circle dashboard-icon text-success"></i>
                    </div>
                    <div class="progress bg-light">
                        <div class="progress-bar bg-success" style="width: {{ $doneProgress ?? 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik atau Statistik lainnya (opsional) -->
        {{-- Bisa ditambahkan chart atau daftar tugas terakhir --}}
    </div>
</section>
@endsection
