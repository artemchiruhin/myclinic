@extends('layouts.admin')

@section('title', 'Все отзывы')

@section('admin-content')
    <h2 class="text-green mb-3">Все отзывы</h2>
    @if (session()->has('feedbackApproved'))
        <div class="alert alert-info mt-3 fadeInLeft">
            <i class="fas fa-info-circle"></i>
            {{ session('feedbackApproved') }}
        </div>
    @endif
    @if (session()->has('feedbackDeleted'))
        <div class="alert alert-danger mt-3 fadeInLeft">
            <i class="fas fa-times-circle"></i>
            {{ session('feedbackDeleted') }}
        </div>
    @endif
    @if (session()->has('feedbackError'))
        <div class="alert alert-danger mt-3 fadeInLeft">
            <i class="fas fa-times-circle"></i>
            {{ session('feedbackError') }}
        </div>
    @endif
    <livewire:admin.feedbacks-list />
    @include('includes.modal-delete')
@endsection
