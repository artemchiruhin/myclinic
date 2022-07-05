<?php

namespace App\Http\Livewire\Admin;

use App\Models\Feedback;
use Livewire\Component;
use Livewire\WithPagination;

class FeedbacksList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortColumn = 'id';
    public $sortDirection = 'asc';
    public $sortStatus = 'all';

    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');
        if($this->sortStatus === 'all') {
            $feedbacks = Feedback::orderBy($this->sortColumn, $this->sortDirection)->paginate(10);
        } else {
            $feedbacks = Feedback::where('approved', $this->sortStatus)->orderBy($this->sortColumn, $this->sortDirection)->paginate(10);
        }
        return view('livewire.admin.feedbacks-list', compact('feedbacks'));
    }

    public function updatingSortStatus()
    {
        $this->resetPage();
    }

    public function sortFeedbacks($status)
    {
        $this->sortStatus = $status;
    }

    public function sortBy($column)
    {
        if($this->sortColumn === $column) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortColumn = $column;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }
}
