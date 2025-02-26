<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
                /* Full-page layout */
                .login-container {
            display: flex;
            height: 100vh;
        }

        /* Left Side - Login Form */
        .login-form {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 40px;
            background-color: #f8f9fa;
        }

        .login-form h2 {
            color: #343a40;
            font-weight: bold;
            margin-bottom: 20px;
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
            margin-top: 15px;
            font-size: 14px;
        }

        /* Right Side - Image & Text */
        .login-image {
        background-image: url('resources\views\admin\picture\loginAdmin.jpg'); /* Corrected path */
        background-size: cover;
        background-position: center;
        height: 100vh; /* Full viewport height */
        color: white; /* Optional: Adjust text color for contrast */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .login-image h1 {
        font-size: 3rem;
        margin-bottom: 20px;
    }

    .login-image p {
        font-size: 1.25rem;
        margin-top: 10px;
    }

        /* Responsive Design */
        @media (max-width: 992px) {
            .login-container {
                flex-direction: column;
            }

            .login-form, .login-image {
                width: 100%;
                height: 50%;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <!-- Left: Login Form -->
    <div class="login-form">
        <h2>Admin Login</h2>
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <input type="email" name="email" class="form-control" placeholder="Email">
            @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <input type="password" name="password" class="form-control" placeholder="Password">
            @error('password')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <button type="submit" class="login-btn"><i class="fas fa-sign-in-alt"></i> Login</button>
        </form>

        <p class="register-link">
            Don't have an account? 
            <a href="{{ route('admin.registerForm') }}">Create an Admin Account</a>
        </p>
    </div>

    <!-- Right: Background Image & Text -->
    <div class="login-image">
        <h1>Welcome to Admin Portal</h1>
        <p>Manage your school's system efficiently and securely.</p>
    </div>
</div>

</body>
</html>
