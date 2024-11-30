@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/weight_logs.css')}}">
@endsection

@section('content')
<div class="weight-logs__content">
    <div class="weight-logs__display">
        <div class="display__target-weight">
            <p class="display__target-weight--title">目標体重</p>
            <div class="display__target-weight--content">
                <span class="display__target-weight--value">{{$targetWeight}}</span>
                <span class="display__target-weight--unit">kg</span>
            </div>
        </div>
        <div class="display__to-target-weight">
            <p class="display__to-target-weight--title">目標まで</p>
            <div class="display__to-target-weight--content">
                <span class="display__to-target-weight--value">{{$toTargetWeight ?? ''}}</span>
                <span class="display__to-target-weight--unit">kg</span>
            </div>
        </div>
        <div class="display__weight">
            <p class="display__weight--title">最新体重</p>
            <div class="display__weight--content">
                <span class="display__weight--value">{{$weight}}</span>
                <span class="display__weight--unit">kg</span>
            </div>
        </div>
    </div>
    <div class="weight-logs__list">
        <div class="list__page">
            <div class="list__header">
                <div class="list__function">
                    <form action="/weight_logs/search" method="get" class="list__search">
                        @csrf
                        @if(isset($dateFrom))
                        <input type="date" name="search_date_from" value="{{$dateFrom}}" class="list__search--date-from">
                        @else
                        <input type="date" name="search_date_from" class="list__search--date-from">
                        @endif
                        <span class="list__search--tilde">~</span>
                        @if(isset($dateFrom))
                        <input type="date" name="search_date_to" value="{{$dateTo}}" class="list__search--date-to">
                        @else
                        <input type="date" name="search_date_to" class="list__search--date-to">
                        @endif
                        <button class="list__search--button">検索</button>
                    </form>
                    
                    <a href="#modal" class="list__create--button">データ追加</a>
                </div>
                @if($searching)
                <a href="/weight_logs" class="list__reset">リセット</a>
                @endif
            </div>
            @if($searching)
            <p class="list__search-between">{{date('Y年m月d日', strtotime($dateFrom))}}~{{date('Y年m月d日', strtotime($dateTo))}} {{$count}}件</p>
            @endif
            <table class="list__table">
                <tr class="table__header">
                    <th class="table__header--date">日付</th>
                    <th class="table__header--weight">体重</th>
                    <th class="table__header--calories">カロリー</th>
                    <th class="table__header--exercise">運動時間</th>
                    <th class="table__header--detail"></th>
                </tr>
                @foreach($weightLogs as $weightLog)
                <tr class="table__row">
                    <td class="table__row--date">{{$weightLog->date}}</td>
                    <td class="table__row--weight">{{$weightLog->weight}}</td>
                    <td class="table__row--calories">{{$weightLog->calories}}</td>
                    <td class="table__row--exercise-time">{{$weightLog->exercise_time}}</td>
                    <td class="table__row--detail">
                        <a href="/weight_logs/{{$weightLog->id}}" class="detail__link">詳細</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        {{$weightLogs->links()}}
    </div>
</div>

<div id="modal" class="modal">
    <a href="" class="modal__outer"></a>
    <div class="modal__inner">
        <p class="modal__title">Weight Logを追加</p>
        <form action="/weight_logs/create" method="post" class="modal__form">
            @csrf
            <div class="modal__group">
                <div class="modal__lavel">
                    <span class="modal__lavel--title">日付</span>
                    <span class="modal__lavel--required">必須</span>
                </div>
                <div class="modal__input">
                    <input type="date" name="date" value="{{old('date') ?: $today}}" class="modal__input--date">
                </div>
                @error('date')
                <p class="modal__error">{{$errors->first('date')}}</p>
                @enderror
            </div>
            <div class="modal__group">
                <div class="modal__lavel">
                    <span class="modal__lavel--title">体重</span>
                    <span class="modal__lavel--required">必須</span>
                </div>
                <div class="modal__input">
                    <input type="text" name="weight" value="{{old('weight')}}" placeholder="50.0" class="modal__input--weight">
                    <span class="modal__input--unit">kg</span>
                </div>
                @error('weight')
                <p class="modal__error">{{$errors->first('weight')}}</p>
                @enderror
            </div>
            <div class="modal__group">
                <div class="modal__lavel">
                    <span class="modal__lavel--title">摂取カロリー</span>
                    <span class="modal__lavel--required">必須</span>
                </div>
                <div class="modal__input">
                    <input type="text" name="calories" value="{{old('calories')}}" placeholder="1200" class="modal__input--calories">
                    <span class="modal__input--unit">cal</span>
                </div>
                @error('calories')
                <p class="modal__error">{{$errors->first('calories')}}</p>
                @enderror
            </div>
            <div class="modal__group">
                <div class="modal__lavel">
                    <span class="modal__lavel--title">運動時間</span>
                    <span class="modal__lavel--required">必須</span>
                </div>
                <div class="modal__input">
                    <input type="time" name="exercise_time" value="{{old('exercise_time')}}" placeholder="00:00" class="modal__input--exercise-time">
                </div>
                @error('exercise_time')
                <p class="modal__error">{{$errors->first('exercise_time')}}</p>
                @enderror
            </div>
            <div class="modal__group">
                <div class="modal__lavel">
                    <span class="modal__lavel--title">運動内容</span>
                </div>
                <div class="modal__input">
                    <textarea name="exercise_content" placeholder="運動内容を追加" class="modal__input--exercise-content">{{old('exercise_content')}}</textarea>
                </div>
            </div>
            <div class="modal__button">
                <a href="" class="modal__button--exit">戻る</a>
                <button class="modal__button--create">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection