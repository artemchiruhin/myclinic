@extends('layouts.app')

@section('title', 'Ваш профиль')

@section('meta-description', 'Личный кабинет клиента клиники коррекции лица и тела MYCLINIC.')

@section('meta-keywords', 'Профиль, личный кабинет')

@section('meta-robots', 'index')

@section('content')
    @include('includes.navigation')
    <div class="container">
        <h1 class="text-dark mt-3">
            <span class="title-bar">Ваш профиль</span>
        </h1>
        <div class="favourites">
            <div class="favourite-block">
                <div class="favourite-block-left">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="favourite-block-right">
                    <span>Любимая услуга:</span>
                    <span>{{ $favourite_service }}</span>
                </div>
            </div>
            <div class="favourite-block">
                <div class="favourite-block-left">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="favourite-block-right">
                    <span>Любимый специалист:</span>
                    <span>{{ $favourite_employee }}</span>
                </div>
            </div>
        </div>
        <h3 class="mt-5">
            <span class="title-bar">История записей</span>
        </h3>
        @if(session()->has('bookingCanceled'))
            <div class="alert alert-danger fadeInLeft">
                {{ session('bookingCanceled') }}
            </div>
        @endif
        @if(count($bookings) > 0)
        <div class="bookings table-responsive">
            <table class="table mt-4">
                <thead>
                    <tr class="text-green">
                        <th>#</th>
                        <th>Услуга</th>
                        <th>Специалист</th>
                        <th>Дата и время</th>
                        <th>Цена</th>
                        <th class="text-center">Действия</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <th>{{ $loop->index + 1 }}</th>
                        <td><a href="{{ route('user.services.show', $booking->service) }}" class="text-green">{{ $booking->service->name }}</a></td>
                        <td>{{ get_name_with_initials($booking->employee) }}</td>
                        <td>{{ $booking->date->format('d.m.Y') . ' ' . substr($booking->time, 0, -3) }}</td>
                        <td>{{ number_format($booking->service->price, 0, ',', ' ') }} <i class="fas fa-ruble-sign"></i></td>
                        <td class="text-center action-buttons-cell">
                            <div class="action-buttons d-flex-center">
                                @if($booking->date->format('Y-m-d') . ' ' . $booking->time > now()->addHours(2)->format('Y-m-d H:i:s'))
                                <form action="{{ route('user.cancel-booking', $booking) }}" method="POST" class="mx-1 form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Отменить запись</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $bookings->links('layouts.pagination') }}
        </div>
        @else
        <h4 class="text-center text-dark">Записей еще не было.</h4>
        @endif
    </div>
@endsection
