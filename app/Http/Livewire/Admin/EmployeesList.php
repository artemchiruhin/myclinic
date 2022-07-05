<?php

namespace App\Http\Livewire\Admin;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeesList extends Component
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
        $employees = Employee::where('last_name', 'LIKE', "%$this->term%")
            ->orWhere('first_name', 'LIKE', "%$this->term%")
            ->orWhere('patronymic', 'LIKE', "%$this->term%")
            ->orderBy('id')
            ->with('serviceCategory')
            ->paginate(10);
        return view('livewire.admin.employees-list', compact('employees'));
    }
}
