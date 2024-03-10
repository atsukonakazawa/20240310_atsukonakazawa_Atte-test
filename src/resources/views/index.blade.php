@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header-nav')
<ul class="header-nav">
        @if (Auth::check())
    <li>
        <a href="/">ホーム</a>
    </li>
    <li>
        <a href="/attendance">日付一覧</a>
    </li>
    <li>
        <form class="logout-form" action="/logout" method="post">
            @csrf
            <button class="logout-button">
                ログアウト
            </button>
        </form>
    </li>
    @endif
</ul>
@endsection

@section('content')
<div class="index-content">
    <div class="index-content__title">
        <h2>{{ Auth::user()->name }}さんお疲れ様です！</h2>
    </div>
    <div class="button-group">
        <form class="start-form" action="{{ route('form.start') }}" method="post">
            @csrf
            <button class="start-button" type="submit">
                勤務開始
            </button>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="punchIn" value="{{ now() }}">
        </form>
        <form class="finish-form" action="{{ route('form.finish') }}" method="post">
            @csrf
            <button class="finish-button" type="submit">
                勤務終了
            </button>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="punchOut" value="{{ now() }}">
        </form>
        <form class="break-form" action="{{ route('form.break') }}" method="post">
            @csrf
            <button class="break-button" type="submit">
                休憩開始
            </button>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        </form>
        <form class="back-form" action="{{ route('form.back') }}" method="post">
            @csrf
            <button class="back-button" type="submit">
                休憩終了
            </button>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        </form>
    </div>


</div>
@endsection