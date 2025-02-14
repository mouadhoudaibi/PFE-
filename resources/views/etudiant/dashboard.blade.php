<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            text-align: center;
            padding-top: 50px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            padding: 40px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .logout-btn {
            background: #d9534f;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: 0.3s;
            border: none;
        }
        .logout-btn:hover {
            background: #c9302c;
        }
    </style>
</head>
<body>


    @extends('layouts.app')

    @section('title', 'Student Dashboard')

    @section('content')
        <h1>Welcome, {{ Auth::user()->name }} 👋</h1>
        <p>We are happy to see you here! Explore your courses, manage your assignments, and stay connected with your teachers.</p>
        
        <h3>Your Group: {{ Auth::user()->group->name }}</h3>
        <p>👥 There are <strong>{{ $studentsInGroup }}</strong> students in your group.</p>

        <h3>Your Grades</h3>
        <ul class="list-group">
            @foreach($grades as $grade)
                <li class="list-group-item">
                    {{ $grade->subject->name }} - Grade: {{ $grade->grade }}
                </li>
            @endforeach
            <!--  calculer la moyenne des notes -->

            <?php
                $sum = 0;
                foreach($grades as $grade){
                    $sum += $grade->grade;
                }
                $averageGrade = $sum / count($grades);
            ?>
              <li class="list-group-item">
                <strong> Average Grade: {{ $averageGrade }} </strong>

              </li>
             
              

        </ul>

        <form action="{{ route('etudiant.logout') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    @endsection


</body>
</html>
