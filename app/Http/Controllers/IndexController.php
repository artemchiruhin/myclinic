<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackFormRequest;
use App\Http\Requests\GeneralDataRequest;
use App\Models\Booking;
use App\Models\Employee;
use App\Models\Feedback;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::with('services')->get();
        $services_count = Service::count();
        $services_word = get_declination_of_word($services_count, array('услуга', 'услуги', 'услуг'));
        $employees_count = Employee::count();
        $employees_word = get_declination_of_word($employees_count, array('сотрудник', 'сотрудника', 'сотрудников'));
        $work_years = date('Y') - 2018;
        $work_years_word = get_declination_of_word($work_years, array('год', 'года', 'лет'));
        $feedbacks = Feedback::where('approved', 1)->inRandomOrder(5)->get();
        $employees = Employee::with('serviceCategory')->get();
        return view('index', compact('feedbacks', 'categories', 'services_count', 'services_word', 'employees_count', 'employees_word', 'employees', 'work_years', 'work_years_word'));
    }

    public function dashboard()
    {
        $categories_count = ServiceCategory::count();
        $categories_word = get_declination_of_word($categories_count, array('категория', 'категории', 'категорий')) . ' услуг';
        $services_count = Service::count();
        $services_word = get_declination_of_word($services_count, array('услуга', 'услуги', 'услуг'));
        $employees_count = Employee::count();
        $employees_word = get_declination_of_word($employees_count, array('сотрудник', 'сотрудника', 'сотрудников'));
        $bookings_count = Booking::count();
        $bookings_word = get_declination_of_word($bookings_count, array('запись', 'записи', 'записей'));
        $feedbacks_count = Feedback::count();
        $feedbacks_word = get_declination_of_word($feedbacks_count, array('отзыв', 'отзыва', 'отзывов'));
        return view('admin.index', compact('categories_count', 'categories_word', 'services_count', 'services_word', 'employees_count', 'employees_word', 'bookings_count', 'bookings_word', 'feedbacks_count', 'feedbacks_word'));
    }

    public function saveGeneralData(GeneralDataRequest $request)
    {
        $validated = $request->validated();
        if(DB::table('general_data')->get()->count() > 0) {
            DB::table('general_data')->update(['address' => $validated['address'], 'phone' => $validated['phone']]);
        } else {
            DB::table('general_data')->insert(['address' => $validated['address'], 'phone' => $validated['phone']]);
        }
        if($request->hasFile('license')) {
            $image = $request->file('license');
            $path = $image->store('license');
            DB::table('general_data')->update(['license' => $path]);
        }
        if($request->hasFile('conclusion')) {
            $image = $request->file('conclusion');
            $path = $image->store('conclusion');
            DB::table('general_data')->update(['conclusion' => $path]);
        }
        return redirect(route('admin.index'))->with('dataSaved', 'Данные успешно сохранены.');
    }

    public function profile()
    {
        $bookings = Booking::where('user_id', auth()->id())->orderBy('date', 'desc')->orderBy('time', 'asc')->paginate(10);
        $favourite_service = DB::table('bookings')
            ->select(DB::raw('service_id, COUNT(*)'))
            ->where('user_id', auth()->id())
            ->groupBy(DB::raw('service_id'))
            ->orderBy('COUNT(*)', 'desc')
            ->limit(1)
            ->get();
        $favourite_service = $favourite_service->count() > 0 ? Service::find($favourite_service[0]->service_id)->name : 'Пока нет';
        $favourite_employee = DB::table('bookings')
            ->select(DB::raw('employee_id, COUNT(*)'))
            ->where('user_id', auth()->id())
            ->groupBy(DB::raw('employee_id'))
            ->orderBy('COUNT(*)', 'desc')
            ->limit(1)
            ->get();
        $favourite_employee = $favourite_employee->count() > 0
            ? get_name_with_initials(Employee::find($favourite_employee[0]->employee_id))
            : 'Пока нет';
        return view('user.profile.index', compact('bookings','favourite_service', 'favourite_employee'));
    }

    public function cancelBooking(Booking $booking)
    {
        if($booking->date->format('Y-m-d') . ' ' . $booking->time > now()->addHours(2)->format('Y-m-d H:i:s')) {
            if($booking->user_id === auth()->id()) {
                if($booking->delete()) {
                    return redirect(route('user.profile'))->with('bookingCanceled', 'Запись была отменена.');
                }
            }
        }
        return redirect(route('user.profile'))->with('cancelError', 'Произошла ошибка.');
    }
}
