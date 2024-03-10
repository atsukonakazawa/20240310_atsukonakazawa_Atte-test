@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('header-nav')
<ul class="header-nav">
    <li>
        <a href="/">ホーム</a>
    </li>
    <li>
        <a href="/attendance">日付一覧</a>
    </li>
    @if (Auth::check())
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

@section('content')
<div class="attendance-content">
    <div class="attendance-content__title">
        <form class="date-form" action="/attendance" method="post">
        @csrf
        <input type="date" name="date"/>
    </div>
</div>
@endsection