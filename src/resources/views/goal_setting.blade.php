@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/goal_setting.css')}}">
@endsection

@section('content')
<div class="goal-setting__content">
    <h2 class="goal-setting__title">目標体重設定</h2>
    <form action="/weight_logs/goal_setting" method="post" class="goal-setting__form">
        @csrf
        <div class="goal-setting__input">
            <input type="number" name="target_weight" value="target_weight" class="goal-setting__input--content">
            <span class="goal-setting__input--unit">kg</span>
        </div>
        <div class="goal-setting__button">
            <a href="/weight_logs" class="goal-setting__button--back">戻る</a>
            <button class="goal-setting__button--update">更新</button>
        </div>
    </form>
    
</div>
@endsection