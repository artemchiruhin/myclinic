<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.svg') }}">
    <livewire:styles />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
    <title>@yield('title')</title>
</head>
<body>
    <div class="admin-wrapper">
        <div class="admin-container">
            <div class="admin-navigation">
                <div class="admin-navigation__top">
                    <div class="admin-logo">
                        <a href="{{ route('index') }}">
                            <img src="{{ asset('img/logo.png') }}" class="logo-img" alt="MYCLINIC">
                        </a>
                    </div>
                    <button type="button" class="btn btn-hamburger">
                        <span></span>
                    </button>
                </div>
                <div class="admin-menu-wrapper">
                    <ul>
                        <li class="@if(route('admin.index') === url()->current()) active @endif">
                            <a href="{{ route('admin.index') }}">Главная</a>
                        </li>
                        <li class="@if(request()->segment(2) === 'service-categories') active @endif">
                            <a href="{{ route('admin.service-categories.index') }}">Категории услуг</a>
                        </li>
                        <li class="@if(request()->segment(2) === 'services') active @endif">
                            <a href="{{ route('admin.services.index') }}">Услуги</a>
                        </li>
                        <li class="@if(request()->segment(2) === 'employees') active @endif">
                            <a href="{{ route('admin.employees.index') }}">Сотрудники</a>
                        </li>
                        <li class="@if(request()->segment(2) === 'bookings') active @endif">
                            <a href="{{ route('admin.bookings.index') }}">Записи</a>
                        </li>
                        <li class="@if(request()->segment(2) === 'feedbacks') active @endif">
                            <a href="{{ route('admin.feedbacks.index') }}">Отзывы</a>
                        </li>
                        <li>
                            <a href="{{ route('user.profile') }}">Личный кабинет</a>
                        </li>
                        <li>
                            <a href="{{ route('auth.logout') }}">Выйти</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <main class="admin-main">
            @yield('admin-content')
        </main>
    </div>
    <livewire:scripts />
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
