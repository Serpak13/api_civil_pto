@extends('layouts.app', ['hideNavbar'=> true])

@section('content')
    <div class="container">
        <div class="tiles-container">
            <a href="{{ route('login') }}" class="tile login-tile">Войти</a>
            <a href="{{ route('register') }}" class="tile register-tile">Регистрация</a>
        </div>
    </div>
@endsection

<style>
    .tiles-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 80vh;
        gap: 20px;
    }

    .tile {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 200px;
        height: 100px;
        background-color: #0080FF;
        color: white;
        text-decoration: none;
        font-size: 20px;
        font-weight: bold;
        border-radius: 10px;
        transition: transform 0.2s, background-color 0.2s, font-size 0.2s;
    }

    .register-tile {
        background-color: #0080FF;
    }

    .tile:hover {
        transform: scale(1.1);
        background-color: #0056b3;
        font-size: 22px;
    }

    .register-tile:hover {
        background-color: #0056b3;
    }
</style>
