<div>
    <div class="search-container mt-4">
        <form action="">
            <div class="input-group">
                <span class="input-group-text text-green" id="basic-addon1"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Поиск по ФИО клиента..." wire:model="term">
            </div>
        </form>
    </div>
    @if(count($bookings) > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr class="text-green">
                    <th>#</th>
                    <th>Клиент</th>
                    <th>Email</th>
                    <th>Телефон</th>
                    <th>Услуга</th>
                    <th>Цена</th>
                    <th>Специалист</th>
                    <th>Дата и время</th>
                    <th class="text-center">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <th>{{ $loop->index + 1 }}</th>
                        <td>{{ $booking->user_id ? get_full_name($booking->user) : $booking->full_name }}</td>
                        <td>{{ $booking->user_id ? $booking->user->email : $booking->email }}</td>
                        <td>{{ $booking->user_id ? $booking->user->phone : $booking->phone }}</td>
                        <td><a href="{{ route('user.services.show', $booking->service) }}" class="text-green">{{ $booking->service->name }}</a></td>
                        <td>{{ number_format($booking->service->price, 0, ',', ' ') }} <i class="fas fa-ruble-sign"></i></td>
                        <td>{{ get_name_with_initials($booking->employee) }}</td>
                        <td>{{ $booking->date->format('d.m.Y') . ' ' . substr($booking->time, 0, -3) }}</td>
                        <td class="text-center action-buttons-cell">
                            <div class="action-buttons d-flex-center">
                                <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="mx-1 form-delete">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">Удалить</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $bookings->links() }}
    @else
        <h4 class="text-center">Записей пока нет.</h4>
    @endif
    @include('includes.modal-delete')
</div>
