@extends('layouts.app')

@section('title', 'Регистрация')

@section('meta-description', 'Регистрация на сайте клиники MYCLINIC')

@section('meta-keywords', 'Регистрация, клиника MYCLINIC')

@section('content')
    <div class="form-wrapper d-flex-center vh-100">
        <div class="container">
            <div class="register-logo text-center">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('img/logo.png') }}" class="logo-img" alt="MYCLINIC">
                </a>
            </div>
            <h1 class="text-center register-title">
                <span class="title-bar">Регистрация</span>
            </h1>
            <form action="{{ route('auth.register') }}" method="POST" class="register-form form-with-rectangles">
                @csrf
                <div class="mb-3">
                    <label for="email">Введите ваш email</label>
                    <input type="email" id="email" value="{{ old('email') }}" name="email" class="form-control @error('email') is-invalid @enderror" autofocus>
                    @error('email')
                    <span class="invalid-feedback fadeInLeft">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Введите ФИО</label>
                    <div class="full-name-group">
                        <div>
                            <input type="text" placeholder="Фамилия" value="{{ old('last_name') }}" name="last_name" class="form-control @error('last_name') is-invalid @enderror">
                            @error('last_name')
                            <span class="invalid-feedback fadeInLeft">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <input type="text" placeholder="Имя" value="{{ old('first_name') }}" name="first_name" class="form-control @error('first_name') is-invalid @enderror">
                            @error('first_name')
                            <span class="invalid-feedback fadeInLeft">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <input type="text" placeholder="Отчество" value="{{ old('patronymic') }}" name="patronymic" class="form-control @error('patronymic') is-invalid @enderror">
                            @error('patronymic')
                            <span class="invalid-feedback fadeInLeft">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="phone">Введите телефон</label>
                    <input type="number" id="phone" value="{{ old('phone') }}" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="89999999999">
                    @error('phone')
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
                <div class="mb-3">
                    <label for="password2">Повторите пароль</label>
                    <input type="password" id="password2" value="{{ old('password_confirmation') }}" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                    <span class="invalid-feedback fadeInLeft">{{ $message }}</span>
                    @enderror
                </div>
                <button class="btn btn-green">Зарегистрироваться</button>
                <p class="form-bottom-label">Есть аккаунт? <a href="{{ route('auth.login') }}" class="text-green">Авторизация</a></p>
            </form>
        </div>
    </div>
@endsection
