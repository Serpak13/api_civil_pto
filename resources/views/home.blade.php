@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex flex-wrap justify-content-between">
                    <!-- Плитка "Новости" -->
                    <a href="#" class="card mb-4 tile" style="width: 18rem;">
                        <img src="{{ asset('images/news.jpg') }}" class="card-img-top" alt="Новости">
                        <div class="card-body">
                            <h5 class="card-title">Новости</h5>
                            <p class="card-text">Последние новости по строительству и нормативам.</p>
                        </div>
                    </a>

                    <!-- Плитка "База сертификатов" -->
                    <a href="#" class="card mb-4 tile" style="width: 18rem;">
                        <img src="{{ asset('images/certificate.png') }}" class="card-img-top" alt="База сертификатов">
                        <div class="card-body">
                            <h5 class="card-title">База сертификатов</h5>
                            <p class="card-text">Доступ к базе сертификатов и документации.</p>
                        </div>
                    </a>

                    <!-- Плитка "Нормативы (ГОСТ, СП)" -->
                    <a href="#" class="card mb-4 tile" style="width: 18rem;">
                        <img src="{{ asset('images/gost.png') }}" class="card-img-top" alt="Нормативы">
                        <div class="card-body">
                            <h5 class="card-title">Нормативы (ГОСТ, СП)</h5>
                            <p class="card-text">Доступ к актуальным нормативным документам.</p>
                        </div>
                    </a>

                    <!-- Плитка "Калькулятор единиц измерений" -->
                    <a href="#" class="card mb-4 tile" style="width: 18rem;">
                        <img src="{{ asset('images/calculate.png') }}" class="card-img-top" alt="Калькулятор">
                        <div class="card-body">
                            <h5 class="card-title">Калькулятор единиц измерений</h5>
                            <p class="card-text">Используйте калькулятор для конверсии единиц.</p>
                        </div>
                    </a>

                    <!-- Плитка "Расчёт строительных материалов" -->
                    <a href="#" class="card mb-4 tile" style="width: 18rem;">
                        <img src="{{ asset('images/materials.png') }}" class="card-img-top" alt="Расчёт материалов">

                        <div class="card-body">
                            <h5 class="card-title">Расчёт строительных материалов</h5>
                            <p class="card-text">Помощь в расчёте необходимого количества материалов.</p>
                        </div>
                    </a>

                    <!-- Плитка "База исполнительных схем" -->
                    <a href="#" class="card mb-4 tile" style="width: 18rem;">
                        <img src="{{ asset('images/plan.png') }}" class="card-img-top" alt="Схемы">

                        <div class="card-body">
                            <h5 class="card-title">База исполнительных схем</h5>
                            <p class="card-text">Доступ к исполнительным схемам и проектам.</p>
                        </div>
                    </a>

                    <!-- Плитка "База актов" -->
                    <a href="#" class="card mb-4 tile" style="width: 18rem;">
                        <img src="{{ asset('images/act.png') }}" class="card-img-top" alt="База актов">
                        <div class="card-body">
                            <h5 class="card-title">База актов</h5>
                            <p class="card-text">Доступ к актуальным актам и протоколам.</p>
                        </div>
                    </a>

                    <!-- Плитка "База знаний" -->
                    <a href="#" class="card mb-4 tile" style="width: 18rem;">
                        <img src="{{ asset('images/baze.png') }}" class="card-img-top" alt="База знаний">
                        <div class="card-body">
                            <h5 class="card-title">База знаний</h5>
                            <p class="card-text">Полезная информация и руководства по строительству.</p>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .tile {
        transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
        cursor: pointer;
        display: block;
        text-decoration: none; /* Убираем подчеркивание */
    }

    .tile:hover {
        transform: scale(1.05);
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        background-color: #f0f0f0; /* Можно заменить на желаемый цвет */
    }

    .tile .card-body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>
