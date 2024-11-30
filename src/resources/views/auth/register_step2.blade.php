@extends('layouts.auth')

@section('css')
<link rel="stylesheet" href="{{asset('css/step2.css')}}">
@endsection

@section('auth_title')
新規会員登録
@endsection

@section('auth_step')
STEP2 体重データの入力
@endsection

@section('auth_content')
<form action="/register/step2" method="post" class="step2__form">
    @csrf
    <div class="form__content">
        <div class="form__group">
            <p class="form__lavel">現在の体重</p>
            <div class="form__input">
                <input type="text" name="weight" value="{{old('weight')}}" class="form__input--content">
                <span class="form__input--unit">kg</span>
            </div>
            @error('weight')
            <p class="form__error">{{$errors->first('weight')}}</p>
            @enderror
        </div>
        <div class="form__group">
            <p class="form__lavel">目標の体重</p>
            <div class="form__input">
                <input type="text" name="target_weight" value="{{old('target_weight')}}" class="form__input--content">
                <span class="form__input--unit">kg</span>
            </div>
            @error('target_weight')
            <p class="form__error">{{$errors->first('target_weight')}}</p>
            @enderror
        </div>
    </div>
    <button class="form__button">アカウント作成</button>
</form>
@endsection