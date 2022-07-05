<div>
    <div class="search-container my-3">
        <form action="">
            <div class="input-group">
                <span class="input-group-text text-green" id="basic-addon1"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Поиск по ФИО..." wire:model="term">
            </div>
        </form>
    </div>
    @if(count($employees) > 0)
        <div class="table-responsive">
            <table class="table">
                <thead class="text-green">
                <tr>
                    <th>ID</th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                    <th>Email</th>
                    <th>Телефон</th>
                    <th>Услуга</th>
                    <th>Начал(а) работать</th>
                    <th>Фотография</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <th>{{ $employee->id }}</th>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->patronymic }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->serviceCategory->name }}</td>
                        <td>{{ $employee->started_at->format('d.m.Y') }}</td>
                        <td>
                            <img src="{{ asset('/storage/' . $employee->image) }}" alt="{{  get_full_name($employee) }}" width="100">
                        </td>
                        <td class="action-buttons-cell">
                            <div class="action-buttons">
                                <a href="{{ route('admin.employees.edit', $employee) }}" class="btn btn-primary mx-1">Изменить</a>
                                <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST" class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Удалить</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $employees->links() }}
    @else
        <h3 class="text-center">Сотрудников пока нет.</h3>
    @endif

    @include('includes.modal-delete')
</div>
