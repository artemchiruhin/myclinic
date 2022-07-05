<?php

namespace App\Http\Livewire\User;

use App\Models\Feedback;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceBookingFeedbacks extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $feedbacks = Feedback::where('service_id', request()->route('service')->id)->paginate(10);
        return view('livewire.user.service-booking-feedbacks', compact('feedbacks'));
    }
}
