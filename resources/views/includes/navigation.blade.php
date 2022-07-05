<nav class="navigation">
    <div class="container main-menu">
        <div class="logo">
            <a href="{{ route('index') }}">
                <img src="{{ asset('img/logo.png') }}" class="logo-img" alt="MYCLINIC">
            </a>
        </div>
        <div class="menu-wrapper">
            <ul class="menu">
                <li class="menu-item">
                    <a href="{{ route('index') . '#about-us' }}">О нас</a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('index') . '#services' }}">Услуги</a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('index') . '#feedbacks' }}">Отзывы</a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('index') . '#employees'}}">Сотрудники</a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('index') . '#license'}}">Лицензия</a>
                </li>
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <li class="admin-panel-item menu-item">
                        <a href="{{ route('admin.index') }}">Панель администратора</a>
                    </li>
                @endif
            </ul>
            @auth
                <div class="nav-buttons">
                    <a class="user-link" href="{{ route('user.profile') }}"><i class="far fa-user"></i> Личный кабинет</a>
                    <a class="btn btn-green-outline" href="{{ route('auth.logout') }}"><i class="fas fa-sign-out-alt"></i> Выход</a>
                </div>
            @endauth
            @guest
                <div class="nav-buttons">
                    <a class="btn btn-green" href="{{ route('auth.login') }}">Вход</a>
                    <a class="btn btn-green-outline" href="{{ route('auth.register') }}">Регистрация</a>
                </div>
            @endguest
        </div>
        <button type="button" class="btn btn-hamburger">
            <span></span>
        </button>
    </div>
</nav>
