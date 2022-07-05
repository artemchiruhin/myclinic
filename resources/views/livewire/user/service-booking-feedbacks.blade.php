<div>
    @foreach($feedbacks as $feedback)
    <div class="service-feedback mb-3">
        <div class="feedback-name">{{ $feedback->name }}</div>
        <div class="feedback-date">Дата: {{ $feedback->created_at ? $feedback->created_at->format('d.m.Y') : '' }}</div>
        <div class="feedback-rating">
            @for($i = 1; $i <= 5; $i++)
                <i class="fas fa-star @if($i <= $feedback->rate) star-selected @endif"></i>
            @endfor
        </div>
        <div class="feedback-text">Комментарий: {{ $feedback->message }}</div>
    </div>
    @endforeach
    {{ $feedbacks->links() }}
</div>
