<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Registration Form</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 400px;
            margin: auto;
            margin-top: 50px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            margin-bottom: 0.5rem;
            font-weight: bold;
            display: block;
        }

        input {
            padding: 10px;
            margin-bottom: 1rem;
            border: 1px solid #ced4da;
            border-radius: 5px;
            width: 100%;
        }

        hr {
            border: 1px solid #ced4da;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .registerbtn {
            background-color: #28a745;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        .registerbtn:hover {
            opacity: 1;
        }

        .signin {
            text-align: center;
            margin-top: 10px;
        }

        .warning-message {
            color: #dc3545;
            font-size: 0.8rem;
            margin-top: 0.2rem;
        }
    </style>
</head>

<body>
    <form action="{{ route('admin.register.create') }}" class="container" method="post" onsubmit="return validatePassword()">
        @csrf
        <h1 class="text-center mb-4">Register</h1>
        <label for="name">UserName</label>
        <input type="text" placeholder="Enter UserName" name="name" id="name" required>

        <label for="email">Email</label>
        <input type="text" placeholder="Enter Email" name="email" id="email" required>

        <label for="psw">Password</label>
        <input type="password" placeholder="Enter Password" name="password" id="psw" required>

        <label for="psw-repeat">Repeat Password</label>
        <input type="password" placeholder="Repeat Password" name="password_confirmation" id="psw-repeat" required>
        <div id="warning-message" class="warning-message"></div>

        <hr>

        <button type="submit" class="registerbtn">Register</button>

        <div class="signin">
            <p>Already have an account? <a href="{{ route('login_form') }}">Sign in</a>.</p>
        </div>

        <script>
            function validatePassword() {
                var password = document.getElementById("psw").value;
                var confirmPassword = document.getElementById("psw-repeat").value;

                if (password !== confirmPassword) {
                    var warningMessage = document.getElementById("warning-message");
                    warningMessage.innerHTML = "Password and Repeat Password do not match.";
                    return false;
                }

                return true;
            }
        </script>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
