@push('scripts')
<script>
    let timerInterval;
    let endTime;
    let isBreak = false;
    const timerDisplay = document.getElementById('timer-display');

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

                // Jika bukan break, maka masuk ke break 5 menit
                if (!isBreak) {
                    isBreak = true;
                    setTimeout(() => {
                        alert('⏰ Saatnya istirahat selama 5 menit!');
                        startTimer(5); // break 5 menit
                    }, 500);
                } else {
                    // Setelah break, kembali ke mode fokus awal
                    isBreak = false;
                    setTimeout(() => {
                        alert('💪 Waktunya fokus kembali!');
                        updateInitialTime(); // reset tampilan waktu awal
                    }, 500);
                }

                return;
            }

            const totalSeconds = Math.floor(remainingMs / 1000);
            const minutes = Math.floor(totalSeconds / 60);
            const seconds = totalSeconds % 60;
            timerDisplay.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        }, 1000);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const taskType = document.getElementById('task-type');
        const startButton = document.getElementById('start-button');

        function updateInitialTime() {
            const initial = taskType.value === 'heavy' ? 45 : 15;
            timerDisplay.textContent = `${String(initial).padStart(2, '0')}:00`;
        }

        taskType.addEventListener('change', updateInitialTime);

        startButton.addEventListener('click', function () {
            const minutes = taskType.value === 'heavy' ? 45 : 15;
            isBreak = false; // reset ke mode fokus
            startTimer(minutes);
        });

        updateInitialTime();
    });

    function triggerVibrate() {
        const alertBox = document.querySelector('.alert-info');
        alertBox.classList.add('vibrate');
        setTimeout(() => alertBox.classList.remove('vibrate'), 1000);
    }

    function playAlarm() {
        const audio = new Audio('https://www.soundjay.com/buttons/sounds/beep-07.mp3');
        audio.play();
    }
</script>
@endpush
