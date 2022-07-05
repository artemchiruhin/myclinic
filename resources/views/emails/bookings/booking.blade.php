@component('mail::message')
# Запись на услугу.

Вы записались на услугу: <span style="color: #08C6AB;">**{{ $booking->service->name }}**</span>

Дата и время: <span style="color: #08C6AB;">**{{ $booking->date->format('d.m.Y') . ' ' . $booking->time }}**</span>

Специалист: <span style="color: #08C6AB;">**{{ get_name_with_initials($booking->employee) }}**</span>

Наш адрес: <span style="color: #08C6AB;">**г. Пермь, {{ array_key_exists(0, $general_data->toArray()) ? $general_data[0]->address : '' }}**</span>

@component('mail::button', ['url' => route('user.profile'), 'color' => 'success'])
В профиль
@endcomponent

С уважением,<br>
MYCLINIC | Клиника коррекции лица и тела
@endcomponent
