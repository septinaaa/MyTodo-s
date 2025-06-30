@extends('layouts.app')

@section('title', 'Profil Pengguna')

@section('content')
<section class="min-vh-100 py-5" style="background: linear-gradient(to bottom right, #0d47a1, #1976d2);">
  <div class="container">
    <div class="card border-0 shadow-sm" style="background-color: #eef4ff;">
      <div class="card-header bg-transparent border-0">
        <h4 class="text-primary fw-bold">👤 Profil Pengguna</h4>
      </div>
      <div class="card-body">
        <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>

        <hr>

        <a href="{{ route('login.google') }}" class="btn btn-outline-danger">
          <i class="bi bi-google"></i> Login dengan Google Lain
        </a>
      </div>
    </div>
  </div>
</section>
@endsection