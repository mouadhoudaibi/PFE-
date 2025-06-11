@extends('layouts.prof')

@section('title', 'Professor Dashboard')

@section('content')

<style>
    body {
        background: #ffffff;
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #34495e;
    }

    .dashboard {
        padding: 30px 40px;
        max-width: 1100px;
        margin: 0 auto;
        background-color: #fff;
        min-height: 100vh;
    }

    h1 {
        font-size: 2.4rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 35px;
        user-select: none;
    }

    .stats-container {
        display: flex;
        gap: 24px;
        margin-bottom: 40px;
        user-select: none;
    }

    .stat-card {
        flex: 1;
        background: #007bff;
        color: white;
        padding: 28px 0;
        border-radius: 14px;
        box-shadow: 0 6px 16px rgba(0, 123, 255, 0.3);
        text-align: center;
        cursor: default;
        transition: background-color 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .stat-card:hover {
        background-color: #0056b3;
    }

    .stat-icon {
        font-size: 3.5rem;
        margin-bottom: 12px;
        opacity: 0.85;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 900;
        margin-bottom: 6px;
        letter-spacing: 1.5px;
    }

    .stat-label {
        font-size: 1.2rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
        gap: 28px;
    }

    .card {
        background-color: #f9f9f9;
        border-radius: 16px;
        padding: 28px 30px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        user-select: none;
    }

    .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        user-select: none;
    }

    .card-icon {
        font-size: 2.7rem;
        color: #007bff;
        margin-right: 18px;
        user-select: none;
    }

    .card-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c3e50;
        user-select: none;
    }

    ul.subjects, ul.groups {
        list-style: none;
        padding-left: 0;
        margin-top: 12px;
        max-height: 320px;
        overflow-y: auto;
    }

    ul.subjects li, ul.groups li {
        padding: 10px 12px;
        font-size: 1.05rem;
        color: #34495e;
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid #e3e6f0;
        transition: background-color 0.15s ease;
        border-radius: 6px;
        cursor: default;
    }

    ul.subjects li:hover, ul.groups li:hover {
        background-color: #e8f0fe;
    }

    .badge {
        background-color: #007bff;
        color: #fff;
        padding: 4px 12px;
        border-radius: 16px;
        font-size: 0.9rem;
        font-weight: 600;
        user-select: none;
        white-space: nowrap;
    }

    .no-data {
        color: #999;
        font-style: italic;
        font-size: 1rem;
        padding: 15px 0;
        user-select: none;
    }

    ul.subjects::-webkit-scrollbar,
    ul.groups::-webkit-scrollbar {
        width: 6px;
    }

    ul.subjects::-webkit-scrollbar-thumb,
    ul.groups::-webkit-scrollbar-thumb {
        background-color: #007bff;
        border-radius: 3px;
    }

</style>

<div class="dashboard">
    <h1>Welcome, {{ Auth::guard('prof')->user()->name }} </h1>

    <div class="stats-container">
        <div class="stat-card" title="Total students in all your groups">
            <i class="fas fa-user-graduate stat-icon"></i>
            <div class="stat-number">{{ $totalStudents }}</div>
            <div class="stat-label">Total Students</div>
        </div>

        <div class="stat-card" title="Subjects assigned to you">
            <i class="fas fa-book-open stat-icon"></i>
            <div class="stat-number">{{ $subjects->count() }}</div>
            <div class="stat-label">Total Subjects</div>
        </div>

        <div class="stat-card" title="Grades you need to review">
            <i class="fas fa-clipboard-check stat-icon"></i>
            <div class="stat-number">{{ $pendingGrades }}</div>
            <div class="stat-label">Groups With Students</div>
        </div>
    </div>

    <div class="dashboard-cards">
        <div class="card" aria-label="Groups you teach">
            <div class="card-header">
                <i class="fas fa-users card-icon"></i>
                <span class="card-title">Groups You Teach</span>
            </div>
            @if(isset($groups) && !$groups->isEmpty())
                <ul class="groups" role="list">
                    @foreach($groups as $group)
                        <li>
                            {{ $group->name }}
                            <span class="badge">{{ $group->etudiants_count }} students</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="no-data">You are not assigned to any groups yet.</p>
            @endif
        </div>

        <div class="card" aria-label="Your subjects">
            <div class="card-header">
                <i class="fas fa-book card-icon"></i>
                <span class="card-title">Your Subjects</span>
            </div>
            @if(isset($subjects) && !$subjects->isEmpty())
                <ul class="subjects" role="list">
                    @foreach($subjects->unique('name') as $subject)
                        <li>
                            {{ $subject->name }}
                            <span class="badge">Coef: {{ $subject->coefficient }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="no-data">No subjects assigned yet.</p>
            @endif
        </div>
    </div>
</div>

@endsection
