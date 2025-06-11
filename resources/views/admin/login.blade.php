<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
            font-weight: bold;
        }

        .form-control {
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .login-btn {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            transition: 0.3s ease;
        }

        .login-btn:hover {
            background-color: #0056b3;
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-box">
        <h2>Admin Login</h2>

<form action="{{ route('admin.login') }}" method="POST">
    @csrf
    <input type="email" name="email" class="form-control" placeholder="Email" required>
    @error('email')
        <p class="text-danger text-center">{{ $message }}</p>
    @enderror

    <input type="password" name="password" class="form-control" placeholder="Password" required>
    @error('password')
        <p class="text-danger text-center">{{ $message }}</p>
    @enderror



    <button type="submit" class="login-btn"><i class="fas fa-sign-in-alt"></i> Login</button>
</form>





        <p class="register-link">
            Don't have an account? 
            <a href="{{ route('admin.registerForm') }}">Create an Admin Account</a>
        </p>
    </div>
</div>

</body>
</html>
