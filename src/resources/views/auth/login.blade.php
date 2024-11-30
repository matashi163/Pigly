@extends('layouts.auth')

@section('css')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('auth_title')
ログイン
@endsection

@section('auth_content')
<form action="/login" method="post" class="login__form">
    @csrf
    <div class="form__content">
        <div class="form__group">
            <p class="form__lavel">メールアドレス</p>
            <input type="text" name="email" value="{{old('email')}}" placeholder="メールアドレスを入力" class="form__input">
            @error('email')
            <p class="form__error">{{$errors->first('email')}}</p>
            @enderror
        </div>
        <div class="form__group">
            <p class="form__lavel">パスワード</p>
            <input type="password" name="password" placeholder="パスワードを入力" class="form__input">
            @error('password')
            <p class="form__error">{{$errors->first('password')}}</p>
            @enderror
        </div>
    </div>
    <button class="form__button">ログイン</button>
</form>
<a href="/register/step1" class="transition__register">アカウント作成はこちら</a>
@endsection