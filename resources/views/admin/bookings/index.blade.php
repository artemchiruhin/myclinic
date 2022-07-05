@extends('layouts.admin')

@section('title', 'Все записи')

@section('admin-content')
    <h2 class="text-green mb-3">Все записи</h2>
    @if (session()->has('bookingDeleted'))
        <div class="alert alert-danger mt-3 fadeInLeft">
            <i class="far fa-times-circle"></i>
            {{ session('bookingDeleted') }}
        </div>
    @endif
    @if (session()->has('bookingError'))
        <div class="alert alert-danger mt-3 fadeInLeft">
            <i class="far fa-times-circle"></i>
            {{ session('bookingError') }}
        </div>
    @endif
    <livewire:admin.bookings-list />
@endsection
