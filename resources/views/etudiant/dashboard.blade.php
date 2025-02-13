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

    <div class="container">
        <h1>Welcome, {{ Auth::user()->name }} 👋</h1>
        <p>We are happy to see you here! Explore your courses, manage your assignments, and stay connected with your teachers.</p>
        
        <h3>Your Group: {{ Auth::user()->group->name }}</h3>
        <p>👥 There are <strong>{{ $studentsInGroup }}</strong> students in your group.</p>
        
        <!-- Logout Button -->
        <form action="{{ route('etudiant.logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

</body>
</html>
