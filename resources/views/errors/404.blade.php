@extends('layouts.app')

@section('title', 'Страница не найдена')

@section('content')
    @include('includes.navigation')
    <section class="error-section">
        <div class="container">
            <h1 class="error-title">
                <span class="title-bar">Ошибка 404</span>
            </h1>
            <div class="error-text">Страница не найдена</div>
            <div class="error-button">
                <a href="{{ route('index') }}" class="btn btn-green">На главную</a>
            </div>
        </div>
    </section>
@endsection
