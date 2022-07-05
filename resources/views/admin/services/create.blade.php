@extends('layouts.admin')

@section('title', 'Добавить услугу')

@section('admin-content')
    <h2 class="text-center text-green mt-5">Добавить услугу</h2>
    <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
        @csrf
        @error('formError')
        <div class="danger alert-danger p-2 mb-2 fadeInLeft">
            <i class="fas fa-times-circle"></i>
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="name" class="form-label">Введите название</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="name" max="255">
            @error('name')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Введите описание</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" id="description">{{ old('description') }}</textarea>
            @error('description')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Цена</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror" id="price">
            @error('price')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Выберите категорию</label>
            <select class="form-select @error('service_category_id') is-invalid @enderror" id="category" name="service_category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($category->id == old('service_category_id')) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('service_category_id')
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
    <a href="{{ route('admin.services.index') }}" class="btn btn-green-outline mt-3"><i class="fas fa-arrow-left"></i> Назад</a>
@endsection
