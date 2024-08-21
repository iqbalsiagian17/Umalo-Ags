<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            color: #343a40;
            font-family: Arial, sans-serif;
            margin: 0;
        }
        .error-container {
            text-align: center;
        }
        .error-code {
            font-size: 96px;
            font-weight: bold;
        }
        .error-message {
            font-size: 24px;
            margin-bottom: 30px;
        }
        .error-link {
            font-size: 18px;
            color: #007bff;
            text-decoration: none;
        }
        .error-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">404</div>
        <div class="error-message">Oops! Page not found.</div>
        <a href="{{ url('/') }}" class="error-link">Go back to Home</a>
    </div>
</body>
</html>
