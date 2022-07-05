@extends('layouts.admin')

@section('title', 'Категорию услуг')

@section('admin-content')
    <h2 class="text-green mb-3">Категории услуг</h2>
    <a href="{{ route('admin.service-categories.create') }}" class="btn btn-green"><i class="fas fa-plus"></i> Добавить</a>
    @if (session()->has('categoryCreated'))
        <div class="alert alert-success mt-3 fadeInLeft">
            <i class="far fa-check-circle"></i>
            {{ session('categoryCreated') }}
        </div>
    @endif
    @if (session()->has('categoryUpdated'))
        <div class="alert alert-info mt-3 fadeInLeft">
            <i class="fas fa-info-circle"></i>
            {{ session('categoryUpdated') }}
        </div>
    @endif
    @if (session()->has('categoryDeleted'))
        <div class="alert alert-danger mt-3 fadeInLeft">
            <i class="fas fa-times-circle"></i>
            {{ session('categoryDeleted') }}
        </div>
    @endif
    @if (session()->has('categoryError'))
        <div class="alert alert-danger mt-3 fadeInLeft">
            <i class="fas fa-times-circle"></i>
            {{ session('categoryError') }}
        </div>
    @endif
    @if(count($categories) > 0)
        <div class="table-responsive">
            <table class="table categories-table mt-4">
                <thead>
                <tr class="text-green">
                    <th>ID</th>
                    <th>Название</th>
                    <th class="text-center">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <th>{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td class="text-center action-buttons-cell">
                            <div class="action-buttons d-flex-center">
                                <a href="{{ route('admin.service-categories.edit', $category) }}" class="btn btn-primary mx-1">Изменить</a>
                                <form action="{{ route('admin.service-categories.destroy', $category) }}" method="POST" class="mx-1 form-delete">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">Удалить</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $categories->links('layouts.pagination') }}
    @else
        <h4 class="text-center mt-3">Категорий пока нет.</h4>
    @endif
    @include('includes.modal-delete')
@endsection
