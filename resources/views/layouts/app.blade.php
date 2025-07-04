<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Todo-s')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<style>
    .navbar-nav .nav-link {
      position: relative;
      transition: color 0.3s;
    }

    .navbar-nav .nav-link::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      height: 2px;
      width: 0;
      background-color: #0d6efd;
      transition: width 0.3s ease-in-out;
    }

    .navbar-nav .nav-link:hover::after,
    .navbar-nav .nav-link.active::after {
      width: 100%;
    }

    .navbar-nav .nav-link.active {
      font-weight: bold;
      color: #0d6efd;
    }

    .navbar-brand {
      font-size: 1.4rem;
    }
    </style>

    <!-- ✅ AOS Styles -->
    @stack('styles')
</head>

<body>

<!-- ✅ NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top py-3">
  <div class="container">
    <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="{{ url('/') }}">
      <i class="fas fa-check-circle me-2 text-primary"></i> Todo-s App
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('main') ? 'active' : '' }}" href="{{ url('/main') }}">
            <i class="fas fa-list-ul me-1"></i> Daftar
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('create') ? 'active' : '' }}" href="{{ url('/create') }}">
            <i class="fas fa-plus-circle me-1"></i> Tambah
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('calendar') ? 'active' : '' }}" href="{{ url('/calendar') }}">
            <i class="fas fa-calendar-alt me-1"></i> Kalender
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('focus-mode') ? 'active' : '' }}" href="{{ url('/focus-mode') }}">
            <i class="fas fa-stopwatch me-1"></i> Fokus
          </a>
        </li>

        @auth
        <li class="nav-item dropdown ms-3">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0d6efd&color=fff&rounded=true" class="rounded-circle me-2" height="32" width="32" alt="User Avatar">
            <span>{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="#">📧 {{ Auth::user()->email }}</a></li>
            <li><a class="dropdown-item" href="{{ route('profile') }}">⚙ Kelola Profil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="dropdown-item" type="submit">🚪 Logout</button>
              </form>
            </li>
          </ul>
        </li>
        @else
        <li class="nav-item ms-3">
          <a href="{{ route('login') }}" class="btn btn-outline-primary">
            <i class="fas fa-sign-in-alt me-1"></i> Login
          </a>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>


<!-- ✅ MAIN CONTAINER -->
<div class="container">
  @if(session()->has('success'))
    <div class="alert alert-success" id="success-alert">
        {{ session()->get('success') }}
    </div>
  @endif

  @yield('content')
</div>

<!-- ✅ SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
    setTimeout(function () {
        $('#success-alert').fadeOut('slow');
    }, 5000);

    $(document).ready(function () {
        $('#due-date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });

        $('#calendar-icon').click(function (event) {
            event.preventDefault();
            $('#due-date').datepicker('show');
        });
    });
</script>

<!-- ✅ AOS Script -->
@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
@endpush

<!-- Stack for additional scripts -->
@stack('scripts')

</body>
</html>
