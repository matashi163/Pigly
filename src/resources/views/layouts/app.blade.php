<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pigly</title>
    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    @yield('css')
</head>
<body>
    <header class="header">
        <h1 class="header__logo">
            Pigly
        </h1>
        <div class="header__content">
            <a href="/weight_logs/goal_setting" class="header__button--goal-setting">目標体重設定</a>
            <form action="/logout" method="post" class="header__logout">
                @csrf
                <button class="header__button--logout">ログアウト</button>
            </form>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>