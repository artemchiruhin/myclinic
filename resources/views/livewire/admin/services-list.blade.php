<div>
    @if(count($services) > 0)
        <div class="table-responsive">
            <table class="table table-bordered services-table mt-4">
                <thead>
                <tr class="text-green">
                    <th>
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <span>ID</span>
                            <i class="fas fa-sort filter-icon" wire:click="sortBy('id')"></i>
                        </div>
                    </th>
                    <th>
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <span>Название</span>
                            <i class="fas fa-sort filter-icon" wire:click="sortBy('name')"></i>
                        </div>
                    </th>
                    <th style="width: 400px;">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <span>Описание</span>
                            <i class="fas fa-sort filter-icon" wire:click="sortBy('description')"></i>
                        </div>
                    </th>
                    <th style="width: 200px;">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <span>Категория</span>
                            <i class="fas fa-sort filter-icon" wire:click="sortBy('service_category_id')"></i>
                        </div>
                    </th>
                    <th>
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <span>Цена</span>
                            <i class="fas fa-sort filter-icon" wire:click="sortBy('price')"></i>
                        </div>
                    </th>
                    <th>Изображение</th>
                    <th class="text-center">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($services as $service)
                    <tr>
                        <th>{{ $service->id }}</th>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->description }}</td>
                        <td>{{ $service->serviceCategory->name }}</td>
                        <td>{{ $service->price }} <i class="fa fa-ruble-sign" style="font-size: 15px;"></i></td>
                        <td><img src="{{ asset('/storage/' . $service->image) }}" alt="{{ $service->name }}" width="200"></td>
                        <td class="text-center action-buttons-cell">
                            <div class="action-buttons d-flex-center">
                                <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-primary mx-1">Изменить</a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="mx-1 form-delete">
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
        {{ $services->links() }}
    @else
        <h4 class="text-center mt-3">Услуг пока нет.</h4>
    @endif
</div>
