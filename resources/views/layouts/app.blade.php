<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Account Registration')</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('style.css') }}">

  <style>
    /* Registration Button */
    .btn-register {
      background-color: #ff9800 !important;
      border-color: #ff9800 !important;
      color: white !important;
    }
    .btn-register:hover {
      background-color: #e68a00 !important;
      border-color: #e68a00 !important;
    }

    /* Social Login Buttons */
    .btn-line {
      background-color: #00C300;
      color: white;
    }
    .btn-apple {
      background-color: black;
      color: white;
    }
    .btn-twitter {
      background-color: #1DA1F2;
      color: white;
    }
    .btn-facebook {
      background-color: #1877F2;
      color: white;
    }
    .btn-social {
      width: 70px;
      height: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      border: none;
      border-radius: 5px;
      font-size: 1rem;
      margin: 0 5px;
    }
    .btn-facebook:hover {
      background-color: #2d4373 !important;
      border-color: #2d4373 !important;
    }

    /* Google Button */
    .btn-google {
      background-color: #ff9800 !important;
      border-color: #ff9800 !important;
      color: white !important;
    }
    .btn-google:hover {
      background-color: #e68a00 !important;
      border-color: #e68a00 !important;
    }
  </style>

  @yield('css')
</head>
<body class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">

  <div class="container">
    @yield('content')
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
