<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        {{ conf('name') }} @yield('title')
    </title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="icon" href="{{ btheme() }}/favicon.png?{{ ver() }}" type="image/png" sizes="220x220">
    <link rel="stylesheet" href="{{ btheme() }}/css/app.min.css">
    <link rel="stylesheet" href="{{ btheme() }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ btheme() }}/css/icons.min.css">
</head>

<body class="auth-body-bg">
    <div class="login-box">

        @yield('content')

    </div>

    <script src="{{ btheme() }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ btheme() }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ btheme() }}/dist/js/adminlte.min.js"></script>
</body>

</html>
