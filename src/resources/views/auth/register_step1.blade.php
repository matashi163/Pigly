@extends('layouts.auth')

@section('css')
<link rel="stylesheet" href="{{asset('css/step1.css')}}">
@endsection

@section('auth_title')
新規会員登録
@endsection

@section('auth_step')
STEP1 アカウント情報の登録
@endsection

@section('auth_content')
<form action="/register" method="post" class="step1__form">
    @csrf
    <div class="form__content">
        <div class="form__group">
            <p class="form__lavel">お名前</p>
            <input type="text" name="name" value="{{old('name')}}" placeholder="名前を入力" class="form__input">
            @error('name')
            <p class="form__error">{{$errors->first('name')}}</p>
            @enderror
        </div>
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
    <button class="form__button">次に進む</button>
</form>
<a href="/login" class="transition__login">ログインはこちら</a>
@endsection