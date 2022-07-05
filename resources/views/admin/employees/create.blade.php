@extends('layouts.admin')

@section('title', 'Добавить сотрудника')

@section('admin-content')
    <h2 class="text-center text-green mt-5">Добавить сотрудника</h2>
    <form method="POST" action="{{ route('admin.employees.store') }}" enctype="multipart/form-data">
        @csrf
        @error('formError')
        <div class="danger alert-danger p-2 mb-2 fadeInLeft">
            <i class="fas fa-times-circle"></i>
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="last_name" class="form-label">Введите фамилию</label>
            <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror" id="last_name">
            @error('last_name')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="first_name" class="form-label">Введите имя</label>
            <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror" id="first_name">
            @error('first_name')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="patronymic" class="form-label">Введите отчество</label>
            <input type="text" name="patronymic" value="{{ old('patronymic') }}" class="form-control @error('patronymic') is-invalid @enderror" id="patronymic">
            @error('patronymic')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Введите email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email">
            @error('email')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Введите телефон</label>
            <input type="number" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="89999999999">
            @error('phone')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Выберите категорию услуг</label>
            <select class="form-select @error('service_category_id') is-invalid @enderror" id="category" name="service_category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($category->id == old('service_category_id')) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('service_category_id')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3 col-12 col-lg-4">
            <label for="started_at" class="form-label">Выберите дату начала работы</label>
            <input type="date" name="started_at" value="{{ old('started_at') }}" class="form-control @error('started_at') is-invalid @enderror" id="started_at" max="{{ date('Y-m-d') }}">
            @error('started_at')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Выберите изображение</label>
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
            @error('image')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-green">Добавить</button>
    </form>
    <a href="{{ route('admin.employees.index') }}" class="btn btn-green-outline mt-3"><i class="fas fa-arrow-left"></i> Назад</a>
@endsection
