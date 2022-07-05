@extends('layouts.admin')

@section('title', 'Добавить категорию услуг')

@section('admin-content')
    <h2 class="text-center text-green mt-5">Добавить категорию услуг</h2>
    <form method="POST" action="{{ route('admin.service-categories.store') }}">
        @csrf
        @error('formError')
        <div class="danger alert-danger p-2 mb-2 fadeInLeft">
            <i class="fas fa-times-circle"></i>
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="name" class="form-label">Введите название</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="name">
            @error('name')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-green">Создать</button>
    </form>
    <a href="{{ route('admin.service-categories.index') }}" class="btn btn-green-outline mt-3"><i class="fas fa-arrow-left"></i> Назад</a>
@endsection
