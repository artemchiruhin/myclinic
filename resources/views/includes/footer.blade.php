<footer class="footer-section">
    <div class="container">
        <div class="footer">
            <div class="map">
                <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Ae53140d2221eb133e8a485a0c8416c0b299daa3c65fff9d671d0e6d156ae799a&amp;source=constructor" width="500" height="300" frameborder="0"></iframe>
            </div>
            <div class="footer-menu-wrapper">
                <ul class="footer-menu">
                    <li>
                        <a href="{{ route('index') . '#about-us' }}">О нас</a>
                    </li>
                    <li>
                        <a href="{{ route('index') . '#services' }}">Услуги</a>
                    </li>
                    <li>
                        <a href="{{ route('index') . '#feedbacks' }}">Отзывы</a>
                    </li>
                    <li>
                        <a href="{{ route('index') . '#employees'}} ">Сотрудники</a>
                    </li>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <li class="admin-panel-item">
                            <a href="{{ route('admin.index') }}">Панель администратора</a>
                        </li>
                    @endif
                    @guest
                        <li>
                            <a href="{{ route('auth.login') }}">Авторизация</a>
                        </li>
                        <li>
                            <a href="{{ route('auth.register') }}">Регистрация</a>
                        </li>
                    @endguest
                </ul>
            </div>
            <div class="contacts">
                <h4>Контакты</h4>
                <ul>
                    <li><i class="fa fa-phone-alt"></i><a href="tel:{{ array_key_exists(0, $general_data->toArray()) ? $general_data[0]->phone : '' }}">{{ array_key_exists(0, $general_data->toArray()) ? $general_data[0]->phone : '' }}</a></li>
                    <li><i class="fas fa-location-arrow"></i> Адрес: {{ array_key_exists(0, $general_data->toArray()) ? $general_data[0]->address : '' }}</li>
                    <li><i class="fas fa-clock"></i> Время работы: ПН-ВС 09:00-21:00</li>
                </ul>
            </div>
        </div>
    </div>
</footer>
