<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pigly</title>
    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('css/auth.css')}}">
    @yield('css')
</head>
<body>
    <div class="auth__content">
        <div class="auth__header">
            <h1 class="auth__logo">Pigly</h1>
            <h2 class="auth__title">
                @yield('auth_title')
            </h2>
            <p class="auth__step">
                @yield('auth_step')
            </p>
        </div>
        @yield('auth_content')
    </div>
</body>
</html>