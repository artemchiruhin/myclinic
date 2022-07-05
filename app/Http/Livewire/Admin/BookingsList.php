<?php

namespace App\Http\Livewire\Admin;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class BookingsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $term;

    public function updatingTerm()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');
        $bookings = Booking::where('full_name', 'LIKE', "%$this->term%")
            ->orWhereHas('user', function (Builder $query) {
                $query->where('first_name', 'like', "%$this->term%")
                    ->orWhere('last_name', 'LIKE', "%$this->term%")
                    ->orWhere('patronymic', 'LIKE', "%$this->term%");
        })->orderBy('date', 'desc')
            ->orderBy('time', 'asc')
            ->paginate(10);
        return view('livewire.admin.bookings-list', compact('bookings'));
    }
}
