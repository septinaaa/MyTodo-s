@push('scripts')
<script>
    let timerInterval;
    let endTime;

    document.addEventListener('DOMContentLoaded', function () {
        const taskType = document.getElementById('task-type');
        const startButton = document.getElementById('start-button');
        const timerDisplay = document.getElementById('timer-display');

        function updateInitialTime() {
            const duration = taskType.value === 'heavy' ? 45 : 15;
            timerDisplay.textContent = `${String(duration).padStart(2, '0')}:00`;
        }

        taskType.addEventListener('change', updateInitialTime);

        startButton.addEventListener('click', function () {
            clearInterval(timerInterval);
            const duration = taskType.value === 'heavy' ? 45 : 15;

            // Hitung waktu berakhir
            endTime = Date.now() + duration * 60 * 1000;

            timerInterval = setInterval(() => {
                const remaining = endTime - Date.now();

                if (remaining <= 0) {
                    clearInterval(timerInterval);
                    timerDisplay.textContent = '00:00';
                    playAlarm();
                    triggerVibrate();
                    return;
                }

                const minutes = Math.floor(remaining / 1000 / 60);
                const seconds = Math.floor((remaining / 1000) % 60);
                timerDisplay.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            }, 1000);
        });

        updateInitialTime();
    });

    function playAlarm() {
        const audio = new Audio("{{ asset('sounds/alarm.mp3') }}");
        audio.play();
    }

    function triggerVibrate() {
        const alertBox = document.querySelector('.alert-info');
        alertBox.classList.add('vibrate');
        setTimeout(() => alertBox.classList.remove('vibrate'), 1500);
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
