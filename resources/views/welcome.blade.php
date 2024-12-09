<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .welcome-container {
            text-align: center;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .welcome-container h1 {
            margin-bottom: 20px;
            font-size: 2rem;
        }

        .welcome-container .btn {
            width: 200px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="welcome-container">
        <h1>Welcome to the Dual Login System</h1>
        <div>
            <a href="{{ route('login') }}?role=admin" class="btn btn-primary">Login as Admin</a>
        </div>
        <div>
            <a href="{{ route('login') }}?role=employee" class="btn btn-secondary">Login as Employee</a>
        </div>
        <div>
            <a href="{{ route('register') }}" class="btn btn-success">Register</a>
        </div>
    </div>
</body>

</html>
