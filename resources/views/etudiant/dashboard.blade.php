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
                                        {{ $grade->subject->name }} - Grade: {{ $grade->grade }}
                                    </li>
                                @endforeach
                                <!-- Average Grade -->
                                <?php
                                    $sum = 0;
                                    foreach($grades as $grade){
                                        $sum += $grade->grade;
                                    }
                                    $averageGrade = count($grades) > 0 ? ($sum / count($grades)) : 0;
                                ?>

                                <li class="list-group-item">
                                    <strong> Average Grade: {{ count($grades) > 0 ? ($sum / count($grades)) : 'No grades available' }} </strong>
                                </li>
                                 <?php
                                 if ($averageGrade >= 10) {
                                    echo '<li class="list-group-item">';
                                    echo '<strong>Admis</strong>';
                                    echo '</li>';
                                 }
                                 else {
                                    echo '<li class="list-group-item">';
                                    echo '<strong>No Admis </strong>';
                                    echo '</li>';
                                    }


                                ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection