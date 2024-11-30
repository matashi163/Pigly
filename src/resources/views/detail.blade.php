@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/detail.css')}}">
@endsection

@section('content')
<div class="detail__content">
    <h2 class="detail__title">Weight Log</h2>
    <form action="/weight_logs/{{$detail['id']}}/update" method="post" class="detail__form">
        @csrf
        <div class="detail__date">
            <p class="detail__lavel">日付</p>
            <div class="detail__input">
                <input type="date" name="date" value="{{$detail['date']}}" class="detail__input--content">
            </div>
            @error('date')
            <p class="detail__error">{{$errors->first('date')}}</p>
            @enderror
        </div>
        <div class="detail__weight">
            <p class="detail__lavel">体重</p>
            <div class="detail__input">
                <input type="text" name="weight" value="{{$detail['weight']}}" class="detail__input--content">
                <span class="detail__input--unit">kg</span>
            </div>
            @error('weight')
            <p class="detail__error">{{$errors->first('weight')}}</p>
            @enderror
        </div>
        <div class="detail__calories">
            <p class="detail__lavel">摂取カロリー</p>
            <div class="detail__input">
                <input type="text" name="calories" value="{{$detail['calories']}}" class="detail__input--content">
                <span class="detail__input--unit">cal</span>
            </div>
            @error('calories')
            <p class="detail__error">{{$errors->first('calories')}}</p>
            @enderror
        </div>
        <div class="detail__exercise-time">
            <p class="detail__lavel">運動時間</p>
            <div class="detail__input">
                <input type="time" name="exercise_time" value="{{$detail['exercise_time']}}" class="detail__input--content">
            </div>
            @error('exercise_time')
            <p class="detail__error">{{$errors->first('exercise_time')}}</p>
            @enderror
        </div>
        <div class="detail__exercise-content">
            <p class="detail__lavel">運動内容</p>
            <div class="detail__input">
                <textarea name="exercise_content" class="detail__input--content">{{$detail['exercise_content']}}</textarea>
            </div>
            @error('exercise_content')
            <p class="detail__error">{{$errors->first('exercise_content')}}</p>
            @enderror
        </div>
        <div class="detail__button">
            <a href="/weight_logs" class="detail__button--back">戻る</a>
            <button class="detail__button--update">更新</button>
            <a href="/weight_logs/{{$detail['id']}}/delete" class="detail__button--delete">削除</a>
        </div>
    </form>
</div>
@endsection