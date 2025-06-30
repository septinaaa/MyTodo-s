@extends('layouts.app')

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

                        {{-- Tombol Login Google --}}
                        <a href="{{ url('/auth/google') }}" class="btn btn-danger w-100 mb-3">
                            <i class="fab fa-google me-2"></i> Login with Google
                        </a>

                        {{-- Form login manual --}}
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control shadow-sm" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control shadow-sm" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 shadow-sm">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection