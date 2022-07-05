@extends('layouts.app')

@section('title', 'Услуга ' . $service->name)

@section('meta-description', $service->description)

@section('meta-keywords', 'Услуга клиники, ' . $service->name)

@section('meta-robots', 'index')

@section('content')
    @include('includes.navigation')
    <main>
        <section>
            <div class="container">
                <div class="service-info">
                    <h1 class="text-dark">
                        <span class="title-bar">{{ $service->name }}</span>
                    </h1>
                    <div class="service-img-block">
                        <img src="{{ asset('/storage/' . $service->image) }}" alt="{{ $service->name }}">
                    </div>
                    <div class="service-info-right">
                        <div class="service-description">{{ $service->description }}</div>
                        <div class="service-category">Категория: <strong class="text-green">{{ $service->serviceCategory->name }}</strong></div>
                        <div class="service-price">Цена: <strong class="text-green">{{ number_format($service->price, 2, '.', ' ') }} <i class="fas fa-ruble-sign"></i></strong></div>
                    </div>
                </div>
                <div class="service-booking">
                    <h3 class="text-dark">
                        <span class="title-bar">Записаться на услугу</span>
                    </h3>
                    <livewire:user.service-booking-form :employees="$employees" :service="$service" />
                </div>
                <div class="service-feedbacks">
                    <h3 class="text-dark">
                        <span class="title-bar">Отзывы</span>
                    </h3>
                    <livewire:user.service-booking-feedbacks />
                </div>
            </div>
        </section>
    </main>
@endsection
