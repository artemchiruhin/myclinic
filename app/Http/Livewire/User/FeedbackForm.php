<?php

namespace App\Http\Livewire\User;

use App\Models\Feedback;
use App\Models\Service;
use Livewire\Component;
use function auth;
use function session;
use function view;

class FeedbackForm extends Component
{
    public $name;
    public $message;
    public $rate;
    public $service_id;
    public $services;

    public function render()
    {
        return view('livewire.user.feedback-form');
    }

    public function mount()
    {
        $this->services = Service::all();
        $this->service_id = $this->services->count() > 0 ? $this->services->first()->id : 0;
        $this->name = auth()->user()->first_name ?? '';
    }

    public function submit()
    {
        $validated = $this->validate([
            'name' => 'required|max:30|string|regex:/^([а-яА-ЯЁё\-]+)$/u',
            'service_id' => 'required|exists:services,id',
            'rate' => 'required|min:1|max:5|integer',
            'message' => 'required|string'
        ]);

        Feedback::create($validated);

        session()->flash('feedbackSent', 'Отзыв отправлен');

        $this->reset();
    }
}
