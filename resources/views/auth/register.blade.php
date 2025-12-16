<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; padding-top: 50px; }
        form { width: 300px; border: 1px solid #ccc; padding: 20px; border-radius: 5px; }
        input { width: 100%; margin-bottom: 10px; padding: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: blue; color: white; border: none; cursor: pointer; }
        .error { color: red; font-size: 0.8em; margin-bottom: 10px; }
    </style>
</head>
<body>

    <form action="{{ route('register') }}" method="POST">
        <h2>Register</h2>
        
        @csrf

        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
        @error('name') <div class="error">{{ $message }}</div> @enderror

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label>Password</label>
        <input type="password" name="password" required>
        @error('password') <div class="error">{{ $message }}</div> @enderror

        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Register</button>
        
        <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
    </form>

</body>
</html>