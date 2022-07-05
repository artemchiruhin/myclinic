@extends('layouts.admin')

@section('title', 'Панель администратора')

@section('admin-content')
    <div class="admin-intro">
        <h1 class="text-green">Панель администратора</h1>
        <p>Добро пожаловать, {{ get_full_name(auth()->user()) }}!</p>
        <p><em class="text-green">Сегодня {{ date('d.m.Y') }}</em></p>
        <h3 class="text-dark mt-5">
            <span class="title-bar">Основная информация</span>
        </h3>
        <div class="admin-info-blocks">
            <div class="admin-info-block">
                <span class="admin-info-block__number">{{ $categories_count }}</span>
                <span>{{ $categories_word }}</span>
            </div>
            <div class="admin-info-block">
                <span class="admin-info-block__number">{{ $services_count }}</span>
                <span>{{ $services_word }}</span>
            </div>
            <div class="admin-info-block">
                <span class="admin-info-block__number">{{ $employees_count }}</span>
                <span>{{ $employees_word }}</span>
            </div>
            <div class="admin-info-block">
                <span class="admin-info-block__number">{{ $bookings_count }}</span>
                <span>{{ $bookings_word }}</span>
            </div>
            <div class="admin-info-block">
                <span class="admin-info-block__number">{{ $feedbacks_count }}</span>
                <span>{{ $feedbacks_word }}</span>
            </div>
        </div>
        <h3 class="text-dark mt-5">
            <sapn class="title-bar">Редактировать данные</sapn>
        </h3>
        @if(session()->has('dataSaved'))
            <div class="alert alert-success fadeInLeft" role="alert">
                <i class="far fa-check-circle"></i>
                {{ session('dataSaved') }}
            </div>
        @endif
        <div class="admin-data">
            <form action="{{ route('admin.index') }}" method="POST" class="admin-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="address">Адрес</label>
                    <input type="text" id="address" value="{{ old('address', array_key_exists(0, $general_data->toArray()) ? $general_data[0]->address : '') }}" name="address" class="form-control @error('address') is-invalid @enderror">
                    @error('address')
                    <span class="invalid-feedback fadeInLeft">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone">Телефон</label>
                    <input type="number" id="phone" value="{{ old('phone', array_key_exists(0, $general_data->toArray()) ? $general_data[0]->phone : '') }}" name="phone" class="form-control @error('phone') is-invalid @enderror">
                    @error('phone')
                    <span class="invalid-feedback fadeInLeft">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="conclusion" class="form-label">Санитарное заключение (необязательно)</label>
                    <input class="form-control @error('conclusion') is-invalid @enderror" type="file" id="conclusion" name="conclusion">
                    @error('conclusion')
                    <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="license" class="form-label">Лицензия (необязательно)</label>
                    <input class="form-control @error('license') is-invalid @enderror" type="file" id="license" name="license">
                    @error('license')
                    <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <button class="btn btn-green">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
