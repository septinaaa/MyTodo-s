@push('scripts')
<script>
    let timerInterval;
    let endTime;
    let isBreak = false;

    document.addEventListener('DOMContentLoaded', function () {
        const taskType = document.getElementById('task-type');
        const startButton = document.getElementById('start-button');
        const timerDisplay = document.getElementById('timer-display');

        if (!timerDisplay || !startButton || !taskType) return;

        function updateInitialTime() {
            const duration = taskType.value === 'heavy' ? 45 : 15;
            timerDisplay.textContent = `${String(duration).padStart(2, '0')}:00`;
        }

        function startTimer(duration) {
            clearInterval(timerInterval);
            endTime = Date.now() + duration * 60 * 1000;

            timerInterval = setInterval(() => {
                const remaining = endTime - Date.now();

                if (remaining <= 0) {
                    clearInterval(timerInterval);
                    timerDisplay.textContent = '00:00';
                    playAlarm();
                    triggerVibrate();

                    // Jeda otomatis setelah selesai
                    if (!isBreak) {
                        isBreak = true;
                        setTimeout(() => {
                            alert("⏳ Istirahat selama 5 menit dimulai!");
                            startTimer(5);
                        }, 1000);
                    } else {
                        isBreak = false;
                        setTimeout(() => {
                            alert("🎯 Waktunya fokus kembali!");
                            updateInitialTime();
                        }, 1000);
                    }

                    return;
                }

                const minutes = Math.floor(remaining / 1000 / 60);
                const seconds = Math.floor((remaining / 1000) % 60);
                timerDisplay.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            }, 1000);
        }

        taskType.addEventListener('change', updateInitialTime);

        startButton.addEventListener('click', function () {
            const duration = taskType.value === 'heavy' ? 45 : 15;
            isBreak = false;
            startTimer(duration);
        });

        updateInitialTime();
    });

    function playAlarm() {
        const audio = new Audio('/sounds/alarm.mp3'); // Pastikan file ini ada di public/sounds
        audio.play().catch(e => console.error("Gagal memainkan audio:", e));
    }

    function triggerVibrate() {
        const alertBox = document.querySelector('.alert-info');
        if (!alertBox) return;
        alertBox.classList.add('vibrate');
        setTimeout(() => alertBox.classList.remove('vibrate'), 1500);
    }
</script>

<style>
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
