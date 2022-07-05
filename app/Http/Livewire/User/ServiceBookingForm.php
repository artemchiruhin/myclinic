<?php

namespace App\Http\Livewire\User;

use App\Mail\BookingMail;
use App\Models\Booking;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ServiceBookingForm extends Component
{
    public $employees;
    public $service;
    public $full_name;
    public $email;
    public $phone;
    public $employee_id;
    public $date;
    public $time;
    public $time_min;

    public function render()
    {
        return view('livewire.user.service-booking-form');
    }

    public function mount()
    {
        $this->time_min = '09';
        $this->employee_id = count($this->employees) > 0 ? $this->employees[0]->id : 0;
    }

    public function updatedDate()
    {
        if($this->date == today()->format('Y-m-d')) {
            $this->time_min = Carbon::now()->addHours(2)->format('H');
        } else {
            $this->time_min = '09';
        }
    }

    public function submit()
    {
        $this->validate([
            'full_name' => Rule::when(!auth()->check(), ['required', 'string', 'regex:/^([а-яА-ЯЁё\-\s]+)$/u', 'max:70']),
            'email' => Rule::when(!auth()->check(), ['required', 'string', 'email', 'max:30']),
            'phone' => Rule::when(!auth()->check(), ['required', 'string', 'regex:/8[0-9]{10}/', 'max:11']),
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date|after:yesterday',
            'time' => 'required'
        ]);
        $is_busy = Booking::where('employee_id', $this->employee_id)
            ->where('date', $this->date)
            ->where('time', $this->time)
            ->get();

        if(count($is_busy) > 0) {
            $this->addError('time_busy', 'Время занято.');
        } else {
            $employee_started_work = Carbon::parse($this->employee()->started_at);
            $chosen_date = Carbon::parse($this->date);
            $days = $chosen_date->diffInDays($employee_started_work);
            $group_start = $employee_started_work->addDays(4 * (ceil($days / 4) - 1));
            if(Carbon::parse($group_start)->addDays(2) == $chosen_date || Carbon::parse($group_start)->addDays(3) == $chosen_date) {
                $this->addError('holiday', 'Сотрудник не работает в выбранный день.');
            } else {
                $booking = Booking::create([
                    'service_id' => $this->service->id,
                    'user_id' => auth()->id() ?? null,
                    'employee_id' => $this->employee_id,
                    'date' => $this->date,
                    'time' => $this->time,
                    'full_name' => $this->full_name,
                    'email' => $this->email,
                    'phone' => $this->phone
                ]);
                if(auth()->check()) {
                    Mail::to(auth()->user())->send(new BookingMail($booking));
                } else {
                    Mail::to($this->email)->send(new BookingMail($booking));
                }
                $this->reset(['full_name', 'email', 'phone', 'date', 'time']);
                session()->flash('success', 'Запись успешно осуществлена.');
            }
        }
    }

    public function employee()
    {
        return Employee::find($this->employee_id);
    }
}
