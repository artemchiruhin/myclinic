@extends('layouts.admin')

@section('title', 'Все сотрудники')

@section('admin-content')
    <h2 class="text-green mb-3">Сотрудники</h2>
    <a href="{{ route('admin.employees.create') }}" class="btn btn-green"><i class="fas fa-plus"></i> Добавить</a>
    @if(session()->has('employeeCreated'))
        <div class="alert alert-success fadeInLeft" role="alert">
            <i class="far fa-check-circle"></i>
            {{ session('employeeCreated') }}
        </div>
    @endif
    @if(session()->has('employeeUpdated'))
        <div class="alert alert-primary fadeInLeft" role="alert">
            <i class="fas fa-info-circle"></i>
            {{ session('employeeUpdated') }}
        </div>
    @endif
    @if(session()->has('employeeDeleted'))
        <div class="alert alert-danger fadeInLeft" role="alert">
            <i class="fas fa-times-circle"></i>
            {{ session('employeeDeleted') }}
        </div>
    @endif
    <livewire:admin.employees-list />
@endsection
