@extends('layouts.app')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Nunito', sans-serif;
    }
</style>
@endpush

@section('content')
<section class="min-vh-100 d-flex align-items-center" style="background: linear-gradient(to bottom right, #0d47a1, #1976d2);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm p-4" style="background-color: #eef4ff;">
                    <h2 class="text-center text-primary fw-bold mb-4">
                        🎯 Mode Fokus (Pomodoro)
                    </h2>

                    <form id="focus-form" class="mb-4">
                        <label for="task-type" class="form-label fw-semibold">Jenis Tugas:</label>
                        <select id="task-type" class="form-control shadow-sm">
                            <option value="light">Ringan (15 menit)</option>
                            <option value="heavy">Berat (45 menit)</option>
                        </select>

                        <div class="text-center mt-4">
                            <button type="button" id="start-button" class="btn btn-primary">
                                <i class="fas fa-play-circle me-1"></i>Mulai Fokus
                            </button>
                        </div>
                    </form>

                    <div class="alert alert-info text-center fs-5">
                        ⏳ Timer: <strong><span id="timer-display">15:00</span></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    let timerInterval;
    let endTime;
    const timerDisplay = document.getElementById('timer-display');

    // Fungsi untuk memulai timer
    function startTimer(durationInMinutes) {
        clearInterval(timerInterval);
        const now = Date.now();
        endTime = now + durationInMinutes * 60 * 1000;

        timerInterval = setInterval(() => {
            const remainingMs = endTime - Date.now();

            if (remainingMs <= 0) {
                clearInterval(timerInterval);
                timerDisplay.textContent = '00:00';
                playAlarm();
                triggerVibrate();
                return;
            }

            const totalSeconds = Math.floor(remainingMs / 1000);
            const minutes = Math.floor(totalSeconds / 60);
            const seconds = totalSeconds % 60;
            timerDisplay.textContent = ${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')};
        }, 1000);
    }

    // Fungsi main saat halaman siap
    document.addEventListener('DOMContentLoaded', function () {
        const taskType = document.getElementById('task-type');
        const startButton = document.getElementById('start-button');

        function updateInitialTime() {
            const initial = taskType.value === 'heavy' ? 45 : 15;
            timerDisplay.textContent = ${String(initial).padStart(2, '0')}:00;
        }

        taskType.addEventListener('change', updateInitialTime);

        startButton.addEventListener('click', function () {
            const minutes = taskType.value === 'heavy' ? 45 : 15;
            startTimer(minutes);
        });

        updateInitialTime();
    });

    // ✅ Animasi vibrasi
    function triggerVibrate() {
        const alertBox = document.querySelector('.alert-info');
        alertBox.classList.add('vibrate');
        setTimeout(() => alertBox.classList.remove('vibrate'), 1000);
    }
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito&display=swap');

    body {
        font-family: 'Nunito', sans-serif;
    }

    .vibrate {
        animation: vibrate 0.3s linear infinite;
    }

    @keyframes vibrate {
        0% { transform: translateX(0); }
        25% { transform: translateX(-2px); }
        50% { transform: translateX(2px); }
        75% { transform: translateX(-2px); }
        100% { transform: translateX(0); }
    }
</style>
@endpush
