<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; padding-top: 50px; }
        form { width: 300px; border: 1px solid #ccc; padding: 20px; border-radius: 5px; }
        input { width: 100%; margin-bottom: 10px; padding: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: green; color: white; border: none; cursor: pointer; }
        .error { color: red; font-size: 0.8em; margin-bottom: 10px; }
    </style>
</head>
<body>

    <form action="{{ route('login') }}" method="POST">
        <h2>Login</h2>

        @csrf

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>

        <p>No account? <a href="{{ route('register') }}">Register here</a></p>
    </form>

</body>
</html>