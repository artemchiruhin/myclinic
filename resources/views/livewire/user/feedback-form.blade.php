<div>
    <div class="feedback-form-block">
        @if(!session()->has('feedbackSent'))
        <form wire:submit.prevent="submit" class="feedback-form">
            @csrf
            <div class="mb-3">
                <label for="name">Ваше имя</label>
                <input wire:model.lazy="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name">
                @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="service">Выберите услугу</label>
                <select class="form-select @error('service_id') is-invalid @enderror" id="service" wire:model="service_id">
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
                @error('service_id')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <p>Ваша оценка</p>
                <div class="stars">
                    <input wire:model="rate" type="radio" value="5" id="rate-5">
                    <label for="rate-5" class="fas fa-star"></label>
                    <input wire:model="rate" type="radio" value="4" id="rate-4">
                    <label for="rate-4" class="fas fa-star"></label>
                    <input wire:model="rate" type="radio" value="3" id="rate-3">
                    <label for="rate-3" class="fas fa-star"></label>
                    <input wire:model="rate" type="radio" value="2" id="rate-2">
                    <label for="rate-2" class="fas fa-star"></label>
                    <input wire:model="rate" type="radio" value="1" id="rate-1">
                    <label for="rate-1" class="fas fa-star"></label>
                </div>
                @error('rate')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="message">Ваш отзыв</label>
                <textarea wire:model.lazy="message" id="message" class="form-control @error('message') is-invalid @enderror"></textarea>
                @error('message')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <button wire:target="submit" wire:loading.attr="disabled" class="btn btn-green">
                    <div wire:loading wire:target="submit" class="spinner-border text-light" style="width: 20px; height: 20px; border-width: 0.2em;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <span wire:loading.remove wire:target="submit">Отправить</span>
                </button>
            </div>
        </form>
        @else
        <div class="form-sent">
            <i class="fas fa-check-circle"></i>
            <h3>Ваш отзыв отправлен!</h3>
        </div>
            @endif
    </div>
</div>
