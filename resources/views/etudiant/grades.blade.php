@extends('layouts.etudiant')
@section('title', 'Grades')

@section('content')

<style>
.content {
    padding: 20px;
    font-family: 'Arial', sans-serif;
}

.centre {
    margin-right: 100%;
    width: 100%;
}

.card-body {
    background-color: #f9f9f9;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.card-title {
    font-size: 20px;
    font-weight: bold;
    color: #333;
}

.card-text {
    font-size: 16px;
    color: #555;
}

.container {
    margin-top: 30px;
}

.table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.table-striped tbody tr:nth-child(odd) {
    background-color: #f2f2f2;
}

.table th, .table td {
    padding: 12px;
    text-align: left;
}

.table th {
    background-color: #343a40;
    color: white;
    font-size: 16px;
}

.table td {
    font-size: 14px;
    color: #333;
}

.table i {
    margin-right: 8px;
}

.table .text-muted {
    font-style: italic;
    color: #888;
}

.alert-warning {
    background-color: #fff3cd;
    color: #856404;
    padding: 15px;
    border-radius: 5px;
    font-size: 16px;
    text-align: center;
    margin-top: 20px;
}

@media (max-width: 768px) {
    .content {
        padding: 10px;
    }

    .card-body {
        padding: 15px;
    }

    .table th, .table td {
        padding: 8px;
    }
}
.link {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-bottom: 20px;
}

.link a {
    text-decoration: none;
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    border-radius: 8px;
    transition: 0.3s ease-in-out;
}

.link a:hover {
    background-color: #0056b3;
}

.link a {
        text-decoration: none;
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border-radius: 8px;
        transition: 0.3s ease-in-out;
    }

    .link a:hover {
        background-color: #0056b3;
    }

    .link a.active {
        background-color: #0056b3;
        font-weight: bold;
        box-shadow: 0 0 10px rgba(0, 91, 187, 0.8);
    }

</style>

        <div class="link">
            <a href="{{ route('etudiant.grades') }}" class="{{ request()->routeIs('etudiant.grades') ? 'active' : '' }}">{{ __('grades.your_grades') }}</a>
            <a href="{{ route('etudiant.totalgrades') }}" class="{{ request()->routeIs('etudiant.totalgrades') ? 'active' : '' }}">{{ __('grades.total_grades') }}</a>
        </div>

         <div class="centre">
                <div class="container mt-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('grades.group') }}: {{ Auth::user()->group->name }}</h5>
                        <p class="card-text">{{ __('grades.students_count') }} <strong>{{ $studentsInGroup }}</strong> {{ __('grades.students_count2') }}.</p>
                    </div>
                </div>

                <div class="container">
                    @if($subjects->isEmpty())
                        <p class="alert alert-warning">{{ __('grades.no_subjects') }}.</p>
                    @else
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th><i class="fas fa-book"></i> {{ __('grades.subject') }}</th>
                                    <th><i class="fas fa-chart-bar"></i> {{ __('grades.coefficient') }}</th>
                                    <th><i class="fas fa-user-tie"></i> {{ __('grades.professor') }}</th>
                                    <th><i class="fas fa-graduation-cap"></i> {{ __('grades.grade1') }}</th>
                                    <th><i class="fas fa-graduation-cap"></i> {{ __('grades.grade2') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($subjects as $subject)
                                    @php
                                        $grade = $grades->where('subject_id', $subject->id)->first();
                                        $grade2 = $grades->where('subject_id', $subject->id)->first();
                                        
                                    @endphp
                                    <tr>
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $subject->coefficient }}</td>
                                        <td>{{ $subject->profs->pluck('name')->unique()->join(', ') }}</td>
                                        <td>
                                            @if($grade)
                                                {{ $grade->grade }} 
                                            @endif
                                        </td>
                                        <td>
                                            @if($grade) 
                                            {{ $grade->grade2 }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>


@endsection
