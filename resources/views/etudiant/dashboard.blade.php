@extends('layouts.etudiant')
@section('title', 'Etudiant Dashboard')

@section('content')

    <!-- Main Content -->
    <div class="main-content">
        <div class="container text-center mt-4">
            <h1 class="text-primary font-weight-bold">Welcome, {{ Auth::user()->name }} 👋</h1>
            <p class="font-weight-bold">We're happy to see you here! Stay connected and track your academic progress.</p>
        </div>

        <!-- Group and Grades -->
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6">
                    <!-- Group Information -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-users"></i> Your Group
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Group: {{ Auth::user()->group->name }}</h5>
                            <p class="card-text">👥 There are <strong>{{ $studentsInGroup }}</strong> students in your group.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Grades Information -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-clipboard-list"></i> Your Grades
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Grades Overview</h5>
                            <ul class="list-group">
                                @foreach($grades as $grade)
                                    <li class="list-group-item">
                                        {{ $grade->subject->name }} - Grade Final:
                                        <?php
                                            $gradeFinal = $grade->grade + $grade->grade2;
                                            $moyenne = $gradeFinal / 2;
                                            echo $moyenne;
                                        ?>
                                    </li>
                                @endforeach
                                
                                <!-- Total and Average Grade -->
                                <?php
                                    $sum = 0;
                                    $count = count($grades) * 2; // Since each subject has grade and grade2
                                    
                                    foreach($grades as $grade){
                                        $sum += ($grade->grade + $grade->grade2);
                                    }
                                    
                                    $averageGrade = $count > 0 ? ($sum / $count) : 0;
                                ?>

                                <li class="list-group-item">
                                    <strong>Total Grade: {{ $sum }}</strong>
                                </li>
                                <li class="list-group-item">
                                    <strong>Average Grade: {{ $averageGrade > 0 ? number_format($averageGrade, 2) : 'No grades available' }}</strong>
                                </li>

                                <!-- Admission Status -->
                                @if ($averageGrade >= 10)
                                    <li class="list-group-item">
                                        <strong class="text-success">Admis ✅</strong>
                                    </li>
                                @else
                                    <li class="list-group-item">
                                        <strong class="text-danger">No Admis ❌</strong>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
