<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Prof</title>
</head>
<body>

    <h1>Welcome, {{ Auth::guard('prof')->user()->name }}!</h1>

    <p>You are logged in as a professor.</p>

    <!-- Link to log out -->
    <form action="{{ route('prof.logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>


    
</body>
</html>