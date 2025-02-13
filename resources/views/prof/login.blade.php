<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Login</title>
</head>
<body>
    <h2>Professor Login</h2>

    <form action="{{ route('prof.login') }}" method="POST">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" value="{{ old('email') }}" required>
            @error('email')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required>
            @error('password')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Login</button>
    </form>

</body>
</html>
