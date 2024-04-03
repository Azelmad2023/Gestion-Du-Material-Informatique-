<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f8f9fa;
        }

        form {
            max-width: 400px;
            margin: auto;
            border: 3px solid #f1f1f1;
            padding: 16px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-end {
            justify-content: flex-end;
        }
    </style>
</head>
<body>
    <form method="POST" action="{{ route('admin.password.update') }}" class="mt-4">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
            @error('password_confirmation')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="btn btn-primary">Reset Password Now</button>
        </div>
    </form>
</body>
</html>
