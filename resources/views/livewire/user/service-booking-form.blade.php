<div class="service-booking-form-block">
    <form method="POST" wire:submit.prevent="submit">
        @csrf
        @guest
        <div class="mb-3">
            <label for="full_name" class="form-label">Введите ФИО</label>
            <input type="text" wire:model="full_name" id="full_name" class="form-control @error('full_name') is-invalid @enderror">
            @error('full_name')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Введите email</label>
            <input type="email" wire:model="email" id="email" class="form-control @error('email') is-invalid @enderror">
            @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Введите телефон</label>
            <input type="number" wire:model="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="89999999999">
            @error('phone')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        @endguest
        <div class="row">
            <div class="col-lg-6 col-12 mb-3">
                <label for="employee">Выберите специалиста</label>
                <select class="form-select @error('employee_id') is-invalid @enderror" id="employee" wire:model="employee_id">
                    @forelse($employees as $employee)
                    <option value="{{ $employee->id }}">{{ get_full_name($employee) }}</option>
                    @empty
                        <option value="0">-- специалистов пока нет --</option>
                    @endforelse
                </select>
                @error('employee_id')
                <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <label for="date">Выберите дату</label>
                <div class="mb-3">
                    <input type="date" class="form-control @error('date') is-invalid @enderror @error('holiday') is-invalid @enderror" wire:model="date" min="{{ date("Y-m-d", strtotime('today')) }}">
                    @error('date')
                    <span class="invalid-feedback fadeInLeft">{{ $message }}</span>
                    @enderror
                    @error('holiday')
                    <span class="invalid-feedback fadeInLeft">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-12 mb-3">
                <label for="time">Выберите время</label>
                <input type="time" id="time" class="form-control @error('time') is-invalid @enderror @error('time_busy') is-invalid @enderror" wire:model="time" step="3600" min="{{ $time_min }}:00" max="20:00">
                @error('time')
                <span class="invalid-feedback fadeInLeft">{{ $message }}</span>
                @enderror
                @error('time_busy')
                <span class="invalid-feedback fadeInLeft">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <button class="btn btn-green" wire:target="submit" wire:loading.attr="disabled">
                    <div wire:loading wire:target="submit" class="spinner-border text-light" style="width: 20px; height: 20px; border-width: 0.2em;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <span wire:loading.remove wire:target="submit">Записаться</span>
                </button>
            </div>
        </div>
    </form>
    @if(session()->has('success'))
        <div class="alert alert-success fadeInLeft">{{ session('success') }}</div>
    @endif
</div>
