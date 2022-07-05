@extends('layouts.app')

@section('title', 'Авторизация')

@section('meta-description', 'Вход в личный кабинет клиента клиники MYCLINIC')

@section('meta-keywords', 'Авторизация, MYCLINIC, личный кабинет пользователя')

@section('content')
    <div class="form-wrapper d-flex-center vh-100">
        <div class="container">
            <div class="auth-logo text-center">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('img/logo.png') }}" class="logo-img" alt="MYCLINIC">
                </a>
            </div>
            <h1 class="login-title text-center">
                <span class="title-bar">Авторизация</span>
            </h1>
            <form action="{{ route('auth.login') }}" method="POST" class="login-form form-with-rectangles">
                @if(session()->has('incorrectData'))
                    <div class="alert alert-danger fadeInLeft" role="alert">
                        {{ session('incorrectData') }}
                    </div>
                @endif
                @csrf
                <div class="mb-3">
                    <label for="email">Введите ваш email</label>
                    <input type="email" id="email" value="{{ old('email') }}" name="email" class="form-control @error('email') is-invalid @enderror" autofocus>
                    @error('email')
                    <span class="invalid-feedback fadeInLeft">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password">Введите пароль</label>
                    <input type="password" id="password" value="{{ old('password') }}" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <span class="invalid-feedback fadeInLeft">{{ $message }}</span>
                    @enderror
                </div>
                <button class="btn btn-green">Войти</button>
                <p class="form-bottom-label">Нет аккаунта? <a href="{{ route('auth.register') }}" class="text-green">Регистрация</a></p>
            </form>
        </div>
    </div>
@endsection
