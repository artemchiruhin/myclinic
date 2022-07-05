@extends('layouts.admin')

@section('title', 'Все услуги')

@section('admin-content')
    <h2 class="text-green mb-3">Все услуги</h2>
    <a href="{{ route('admin.services.create') }}" class="btn btn-green"><i class="fas fa-plus"></i> Добавить</a>
    @if (session()->has('serviceCreated'))
        <div class="alert alert-success mt-3 fadeInLeft">
            <i class="far fa-check-circle"></i>
            {{ session('serviceCreated') }}
        </div>
    @endif
    @if (session()->has('serviceUpdated'))
        <div class="alert alert-info mt-3 fadeInLeft">
            <i class="fas fa-info-circle"></i>
            {{ session('serviceUpdated') }}
        </div>
    @endif
    @if (session()->has('serviceDeleted'))
        <div class="alert alert-danger mt-3 fadeInLeft">
            <i class="fas fa-times-circle"></i>
            {{ session('serviceDeleted') }}
        </div>
    @endif
    @if (session()->has('serviceError'))
        <div class="alert alert-danger mt-3 fadeInLeft">
            <i class="fas fa-times-circle"></i>
            {{ session('serviceError') }}
        </div>
    @endif
    <livewire:admin.services-list />
    @include('includes.modal-delete')
@endsection
