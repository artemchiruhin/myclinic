<div>
    <div class="filter-buttons">
        <button type="button" class="btn @if($sortStatus === 'all') btn-filter-active @endif" wire:click="sortFeedbacks('all')">Все</button>
        <button type="button" class="btn @if($sortStatus === '1') btn-filter-active @endif" wire:click="sortFeedbacks('1')">Одобрено</button>
        <button type="button" class="btn @if($sortStatus === '0') btn-filter-active @endif" wire:click="sortFeedbacks('0')">Не одобрено</button>
    </div>
    @if(count($feedbacks) > 0)
        <div class="table-responsive">
            <table class="table table-bordered mt-4">
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
                            <span>Имя</span>
                            <i class="fas fa-sort filter-icon" wire:click="sortBy('name')"></i>
                        </div>
                    </th>
                    <th style="width: 700px;">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <span>Сообщение</span>
                            <i class="fas fa-sort filter-icon" wire:click="sortBy('message')"></i>
                        </div>
                    </th>
                    <th>
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <span>Оценка (из 5-ти)</span>
                            <i class="fas fa-sort filter-icon" wire:click="sortBy('rate')"></i>
                        </div>
                    </th>
                    <th>Статус</th>
                    <th class="text-center">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($feedbacks as $feedback)
                    <tr>
                        <th>{{ $feedback->id }}</th>
                        <td>{{ $feedback->name }}</td>
                        <td>{{ $feedback->message }}</td>
                        <td>{{ $feedback->rate }}</td>
                        <td>{{ $feedback->approved == 1 ? 'Одобрено' : 'Не одобрено' }}</td>
                        <td class="text-center action-buttons-cell">
                            <div class="action-buttons d-flex-center">
                                @if($feedback->approved == 0)
                                    <form action="{{ route('admin.feedbacks.approve', $feedback) }}" method="POST" class="mx-1">
                                        @csrf
                                        @method('put')
                                        <button class="btn btn-success">Одобрить</button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.feedbacks.destroy', $feedback) }}" method="POST" class="mx-1 form-delete">
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
        {{ $feedbacks->links() }}
    @else
        <h4 class="text-center mt-3">Отзывов пока нет.</h4>
    @endif
</div>
