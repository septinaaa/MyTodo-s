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

    function updateInitialTime() {
        const type = document.getElementById('task-type').value;
        const initialMinutes = type === 'heavy' ? 45 : 15;
        document.getElementById('timer-display').textContent = `${String(initialMinutes).padStart(2, '0')}:00`;
    }

    document.addEventListener('DOMContentLoaded', function () {
        const taskType = document.getElementById('task-type');
        const startButton = document.getElementById('start-button');
        const timerDisplay = document.getElementById('timer-display');

        taskType.addEventListener('change', updateInitialTime);

        startButton.addEventListener('click', function () {
            clearInterval(timerInterval);

            let minutes = taskType.value === 'heavy' ? 45 : 15;
            let seconds = 0;

            timerInterval = setInterval(() => {
                if (seconds === 0) {
                    if (minutes === 0) {
                        clearInterval(timerInterval);
                        alert("✅ Waktu fokus selesai! Saatnya istirahat.");
                        return;
                    } else {
                        minutes--;
                        seconds = 59;
                    }
                } else {
                    seconds--;
                }

                timerDisplay.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            }, 1000);
        });

        updateInitialTime();
    });
</script>
@endpush
