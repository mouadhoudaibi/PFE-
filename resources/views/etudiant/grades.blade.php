@extends('layouts.etudiant')
@section('title', 'Grades')

@section('content')

<style>
    /* General content styling */
.content {
    padding: 20px;
    font-family: 'Arial', sans-serif;
}

.centre {
    margin-right: 100%;
    width: 100%;
}

/* Student Info Section */
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

/* Grades Section */
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

/* Alert styling for no subjects found */
.alert-warning {
    background-color: #fff3cd;
    color: #856404;
    padding: 15px;
    border-radius: 5px;
    font-size: 16px;
    text-align: center;
    margin-top: 20px;
}

/* Responsive design for smaller screens */
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

</style>


        <!-- Student Info Section -->
         <div class="centre">
                <div class="container mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Group: {{ Auth::user()->group->name }}</h5>
                        <p class="card-text">👥 There are <strong>{{ $studentsInGroup }}</strong> students in your group.</p>
                    </div>
                </div>

                <!-- Grades Section -->
                <div class="container">
                    @if($subjects->isEmpty())
                        <p class="alert alert-warning">No subjects found.</p>
                    @else
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th><i class="fas fa-book"></i> Subject</th>
                                    <th><i class="fas fa-chart-bar"></i>Coefficient</th>
                                    <th><i class="fas fa-user-tie"></i> Professor</th>
                                    <th><i class="fas fa-graduation-cap"></i> Grade 1</th>
                                    <th><i class="fas fa-graduation-cap"></i>Grade 2</th>
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
