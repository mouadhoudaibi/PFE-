*etudiant dashboard* <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <!-- Bootstrap & Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        /* Sidebar Styles */
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .sidebar a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #000;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: bold;
        }
        .sidebar a:hover {
            background-color: #dcdcdc;
        }
        .sidebar .logout-btn {
            background-color: #dc3545;
            border: none;
            margin-top: 20px;
            padding: 10px;
            text-align: center;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }
        .sidebar .logout-btn:hover {
            background-color: #c82333;
        }
        /* Top bar */
        .top-bar {
            background-color: #343a40;
            color: white;
            padding: 15px 30px; /* Added padding to left, right, and top */
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-left: 250px;
        }
        .top-bar .user-info {
            font-size: 18px;
            font-weight: bold;
        }
        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
        .navbar {
            display: none;
        }
        .container {
            margin-top: 30px;
        }
        .card {
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #343a40;
            color: white;
        }
        .card-body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#"><i class="fas fa-home"></i> Home</a>
        <a href="#"><i class="fas fa-book"></i> Your Courses</a>
        <a href="#"><i class="fas fa-graduation-cap"></i> Your Grades</a>
        <a href="{{ route('etudiant.assignments') }}"><i class="fas fa-tasks"></i> Assignments</a>

        <form action="{{ route('etudiant.logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>

    <!-- Top Bar -->
    <div class="top-bar">
        <h2><i class="fas fa-chalkboard-teacher"></i> Student Dashboard</h2>
        <span class="user-info"><i class="fas fa-user"></i> {{ Auth::user()->name }}</span>
    </div>

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

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
