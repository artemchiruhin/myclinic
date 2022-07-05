@extends('layouts.app')

@section('title', 'Клиника коррекции лица и тела MYCLINIC')

@section('meta-description', 'Медико-эстетический центр MYCLINIC. Центр коррекции лица и тела. Косметлогические услуги.')

@section('meta-keywords', 'MYCLINIC, коррекция лица, коррекция тела, косметические услуги, косметология, косметологические услуги')

@section('meta-robots', 'index')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/swiper.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/swiper.js') }}"></script>
    <script src="{{ asset('js/scrolltrigger.js') }}"></script>
    <script src="{{ asset('js/gsap.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
@endsection

@section('content')
    <header class="intro-section header-with-nav">
        @include('includes.navigation')
        <div class="intro-wrapper d-flex-center">
            <div class="container intro">
                <div class="intro-left">
                    <h1 class="text-green intro-title">Клиника коррекции лица и тела</h1>
                    <p>Мы предоставляем различные услуги по уходу за лицом и телом.</p>
                    <button class="btn btn-green intro-button" type="button"><i class="fa fa-arrow-down"></i> Наши услуги</button>
                </div>
                <div class="intro-right">
                    <div class="intro-img-block">
                        <img src="{{ asset('img/intro-img.jpg') }}" alt="Клиника myclinic" class="intro-img">
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="about-us-section" id="about-us">
        <div class="container about-us">
            <h2 class="title text-dark text-center">
                <span class="title-bar">О нас</span>
            </h2>
            <div class="about-us__info">
                <div class="about-us__info-img-block">
                    <img src="{{ asset('img/about-us-img.jpg') }}" alt="О нас">
                </div>
                <div class="about-us__info-blocks">
                    <div class="text-center text-white">
                        <h3 class="">{{ $work_years }}</h3>
                        <strong>{{ $work_years_word }} работы</strong>
                    </div>
                    <div class="text-center text-white">
                        <h3 class="">{{ $employees_count }}</h3>
                        <strong>{{ $employees_word }}</strong>
                    </div>
                    <div class="text-center text-white">
                        <h3 class="">{{ $services_count }}</h3>
                        <strong>{{ $services_word }}</strong>
                    </div>
                    <div class="text-center text-white">
                        <h3 class="">{{ array_key_exists(0, $general_data->toArray()) ? $general_data[0]->address : '' }}</h3>
                        <strong>адрес клиники</strong>
                    </div>
                </div>
            </div>
            <div class="about-us__description col-12 col-lg-6">
                Клиника существует с 2018 года. С этого момента мы отобрали лучших специалистов, наполнили пространство уютом и приобрели более 150 постоянных клиентов
            </div>
            <div class="about-us__images">
                <div>
                    <img src="{{ asset('/img/about-us-img2.jpg') }}" alt="MYCLINIC">
                </div>
                <div>
                    <img src="{{ asset('/img/about-us-img3.jpg') }}" alt="MYCLINIC">
                </div>
                <div>
                    <img src="{{ asset('/img/about-us-img4.jpg') }}" alt="MYCLINIC">
                </div>
            </div>
        </div>
    </section>
    <section class="services-section" id="services">
        <div class="container">
            <h2 class="title text-dark text-center">
                <span class="title-bar">Наши услуги</span>
            </h2>
            @if(count($categories) > 0)
            <div class="services">
                @foreach($categories as $category)
                <div class="service">
                    <div class="service-top">
                        <div class="service-title">{{ $category->name }}</div>
                        <div class="plus"></div>
                    </div>
                    <div class="service-list">
                        <ul>
                            @forelse($category->services as $service)
                            <li>{{ $service->name }} <a href="{{ route('user.services.show', $service) }}">Подробнее</a></li>
                            @empty
                                <li>Услуг данной категории пока нет</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
            @else
                <h4 class="text-center title">Услуг пока нет</h4>
            @endif
        </div>
    </section>
    <section class="feedbacks-section" id="feedbacks">
        <div class="container">
            <h2 class="title text-dark text-center">
                <span class="title-bar">Отзывы</span>
            </h2>
            @if(count($feedbacks) > 0)
            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach($feedbacks as $feedback)
                    <div class="swiper-slide">
                        <div class="slide-content">
                            <div class="feedback-name">{{ $feedback->name }}</div>
                            <div class="feedback-date">Дата: {{ $feedback->created_at ? $feedback->created_at->format('d.m.Y') : '' }}</div>
                            <div class="feedback-service">Услуга: {{ $feedback->service->name }}</div>
                            <div class="feedback-rating">
                                @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star @if($i <= $feedback->rate) star-selected @endif"></i>
                                @endfor
                            </div>
                            <div class="feedback-text">Комментарий: {{ $feedback->message }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            @else
            <h4 class="text-center title">Отзывов пока нет</h4>
            @endif
        </div>
    </section>
    <section class="employees-section" id="employees">
        <div class="container">
            <h2 class="title text-dark text-center">
                <span class="title-bar">Наши сотрудники</span>
            </h2>
            <div class="employees">
                @forelse($employees as $employee)
                <div class="employee">
                    <div class="employee-img-block">
                        <img src="{{ asset('/storage/' . $employee->image) }}" alt="{{ get_full_name($employee) }}">
                    </div>
                    <h4 class="employee-full-name">{{ get_full_name($employee) }}</h4>
                    <div class="employee-service">
                        <span>Специалист по:</span>
                        <span>{{ $employee->serviceCategory->name }}</span>
                    </div>
                </div>
                @empty
                    <h4 class="text-center title" style="grid-column: 1 / 4">Сотрудников пока нет.</h4>
                @endforelse
            </div>
        </div>
    </section>
    <section class="license-section" id="license">
        <div class="container">
            <h2 class="title text-dark text-center">
                <span class="title-bar">Наша лицензия</span>
            </h2>
            <div class="license">
                <div><img src="{{ array_key_exists(0, $general_data->toArray()) ? asset('/storage/' .  $general_data[0]->conclusion) : '' }}" alt="Санитарно-эпидемологическое заключение"></div>
                <div><img src="{{ array_key_exists(0, $general_data->toArray()) ? asset('/storage/' .  $general_data[0]->license) : '' }}" alt="Лицензия"></div>
            </div>
            <p class="text-dark text-center">Лицензия ЛО-59-01-005463</p>
        </div>
    </section>
    <section class="feedback-form-section">
        <div class="container">
            <h2 class="title text-dark text-center">
                <span class="title-bar">Оставьте отзыв</span>
            </h2>
            <livewire:user.feedback-form />
        </div>
    </section>
@endsection


