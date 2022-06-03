@extends('default')
@section('title')
   Time2Share
@endsection
@section('content')
@if (Route::has('login'))
    <h3 class="welcome-title">Time2Share</h3>
    <article class="sign_in">
        @auth
            <a href="{{ route('dashboard', ['id' => Auth::user()->id]) }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="login_link">Log in</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="register_link">Register</a>
            @endif
        @endauth
    </article>
@endif
@endsection
<style>
    body {
        background: rgb(243 244 246);
    }
</style>