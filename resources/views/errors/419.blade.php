<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>419 - Page Expired</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/Sahel/Sahel.css">

    <style>
        html, body {
            font-family: 'Sahel', sans-serif !important;
        }
        * {
            font-family: inherit !important;
        }

        body {
            background-color: #f8f9fa;
        }

        .error-container {
            margin-top: 10%;
        }

        .error-code {
            font-size: 8rem;
            font-weight: bold;
            color: #6c757d;
        }

        .error-message {
            font-size: 1.5rem;
            color: #333;
        }

        .btn-home {
            margin-top: 2rem;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
<div class="container text-center error-container">
    <div class="error-code">419</div>
    <div class="error-message">Oops! Page Expired.</div>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-home">Return to Dashboard</a>
</div>
</body>
</html>
