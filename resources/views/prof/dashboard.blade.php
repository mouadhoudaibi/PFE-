@extends('layouts.prof')

@section('title', 'Professor Dashboard')

@section('content')

<!-- Styles for the Dashboard -->
<style>
    /* General Dashboard Layout */
    .dashboard {
        padding: 20px;
    }

    /* Dashboard Cards Layout */
    .dashboard-cards {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 20px;
    }

    /* Individual Card */
    .card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 300px;
        display: flex;
        align-items: center;
        transition: transform 0.2s ease-in-out;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card-icon {
        font-size: 2rem;
        color: #007bff;
        margin-right: 15px;
    }

    .card-content h3 {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .card-content p,
    .card-content ul {
        margin: 0;
        font-size: 14px;
        color: #666;
    }

    .subjects {
        list-style: none;
        padding: 0;
    }

    .subjects li {
        display: flex;
        align-items: center;
        padding: 5px 0;
    }

    .subjects li::before {
        content: "📖 ";
        margin-right: 5px;
    }
</style>

<!-- Dashboard Content -->
<div class="dashboard">
    <div class="container-fluid mt-4">
        <h1>Welcome, {{ Auth::guard('prof')->user()->name }} 👨‍🏫</h1>

        <div class="dashboard-cards">
            <!-- Groups Card -->
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-content">
                    <h3>Groups You Teach</h3>
                    @if(isset($groups) && !$groups->isEmpty())
                        <ul class="subjects">
                            @foreach($groups as $group)
                                <li>{{ $group->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>You are not assigned to any groups yet.</p>
                    @endif
                </div>
            </div>

            <!-- Subjects Card -->
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="card-content">
                    <h3>Subjects</h3>
                    @if(isset($subjects) && !$subjects->isEmpty())
                        <ul class="subjects">
                            @foreach($subjects->unique('name') as $subject)
                                <li>
                                    {{ $subject->name }} 
                                    <span><strong>Coefficient: {{ $subject->coefficient }}</strong></span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>You have not been assigned any subjects yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
