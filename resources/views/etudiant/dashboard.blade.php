@extends('layouts.etudiant')
@section('title', 'Student Dashboard')

@section('content')

<style>

    .card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgb(0 0 0 / 0.1);
        transition: box-shadow 0.3s ease;
    }
    .card:hover {
        box-shadow: 0 8px 20px rgb(0 0 0 / 0.15);
    }

    .card-header {
        font-weight: 600;
        font-size: 1.1rem;
        letter-spacing: 0.02em;
    }
    button.btn {
        border-radius: 8px;
        font-weight: 600;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    button.btn-primary:hover {
        background-color: #0b5ed7;
        color: #fff;
    }
    button.btn-outline-primary {
        border-width: 2px;
    }
    button.btn-outline-primary:hover {
        background-color: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }
    button.btn-outline-warning:hover {
        background-color: #ffc107;
        color: #212529;
        border-color: #ffc107;
    }
    button.btn-outline-secondary {
        border-width: 2px;
    }
    #timer {
        font-weight: 700;
        letter-spacing: 0.15em;
    }
    .text-primary {
        color: #0d6efd !important;
    }
    .text-secondary {
        color: #6c757d !important;
    }
    .gap-3 > * {
        margin-right: 12px;
    }
    .gap-3 > *:last-child {
        margin-right: 0;
    }
</style>

<div class="main-content py-5">
    <div class="container text-center mb-5">
        <h1 class="fw-bold text-primary">{{ __('dashboardstudent.welcome', ['name' => Auth::user()->name]) }}</h1>
        <p class="fw-semibold text-secondary fs-5">{{ __('dashboardstudent.stay_focused') }}</p>
    </div>

    <div class="container">
        <div class="row g-4">

            <section class="col-md-6">
                <div class="card border-0">
                    <header class="card-header bg-light border-bottom px-4 py-3">
                        <h5 class="mb-0">{{ __('dashboardstudent.my_goal_notes') }}</h5>
                    </header>
                    <div class="card-body px-4 py-3">
                        <textarea id="noteArea" class="form-control mb-3 shadow-sm border rounded-2" rows="5"
                            placeholder="{{ __('dashboardstudent.goal_placeholder') }}"></textarea>
                        <button onclick="saveNote()" class="btn btn-outline-primary w-100">{{ __('dashboardstudent.save_note') }}</button>
                    </div>
                </div>
            </section>


            <section class="col-md-6">
                <div class="card border-0">
                    <header class="card-header bg-light border-bottom px-4 py-3">
                        <h5 class="mb-0">{{ __('dashboardstudent.academic_overview') }}</h5>
                    </header>
                    <div class="card-body text-center px-4 py-4">
                        <div class="mb-4">
                            <h6 class="mb-1 fw-semibold">{{ __('dashboardstudent.average_grade') }}</h6>
                            <p class="fs-1 fw-bold text-primary mb-0">{{ number_format($averageGrade, 2) }} / 20</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="mb-1 fw-semibold">{{ __('dashboardstudent.modules_studying') }}</h6>
                            <p class="fs-5 mb-0">{{ $moduleCount }}</p>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-semibold">{{ __('dashboardstudent.classmates_group') }}</h6>
                            <p class="fs-5 mb-0">{{ $studentsInGroup }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="col-md-6">
                <div class="card border-0">
                    <header class="card-header bg-light border-bottom px-4 py-3">
                        <h5 class="mb-0">{{ __('dashboardstudent.study_timer') }}</h5>
                    </header>
                    <div class="card-body text-center px-4 py-4">
                        <h1 id="timer" class="display-4 text-danger mb-3">25:00</h1>
                        <div class="d-flex justify-content-center gap-3">
                            <button id="startPauseBtn" class="btn btn-outline-primary" onclick="toggleTimer()">{{ __('dashboardstudent.start') }}</button>
                            <button class="btn btn-outline-secondary" onclick="resetTimer()">{{ __('dashboardstudent.reset') }}</button>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

<script>
    const noteArea = document.getElementById('noteArea');

    window.onload = () => {
        const savedNote = localStorage.getItem('studentNote');
        if (savedNote) {
            noteArea.value = savedNote;
        }
    };

    function saveNote() {
        localStorage.setItem('studentNote', noteArea.value);
        alert("{{ __('dashboardstudent.note_saved') }}");
    }

    let timer;
    let timeLeft = 25 * 60;
    let isRunning = false;

    function toggleTimer() {
        const button = document.getElementById('startPauseBtn');

        if (!isRunning) {
            button.innerHTML = '{{ __("dashboardstudent.pause") }}';
            button.classList.replace('btn-outline-primary', 'btn-outline-warning');
            startTimer();
            isRunning = true;
        } else {
            button.innerHTML = '{{ __("dashboardstudent.start") }}';
            button.classList.replace('btn-outline-warning', 'btn-outline-primary');
            pauseTimer();
            isRunning = false;
        }
    }

    function startTimer() {
        timer = setInterval(() => {
            if (timeLeft <= 0) {
                clearInterval(timer);
                alert("⏰ {{ __('dashboardstudent.time_up') }}");
                resetTimer();
            } else {
                timeLeft--;
                updateTimerDisplay();
            }
        }, 1000);
    }

    function pauseTimer() {
        clearInterval(timer);
    }

    function resetTimer() {
        clearInterval(timer);
        timeLeft = 25 * 60;
        updateTimerDisplay();
        const button = document.getElementById('startPauseBtn');
        button.innerHTML = '{{ __("dashboardstudent.start") }}';
        button.classList.replace('btn-outline-warning', 'btn-outline-primary');
        isRunning = false;
    }

    function updateTimerDisplay() {
        const minutes = String(Math.floor(timeLeft / 60)).padStart(2, '0');
        const seconds = String(timeLeft % 60).padStart(2, '0');
        document.getElementById('timer').innerText = `${minutes}:${seconds}`;
    }
</script>
@endsection
