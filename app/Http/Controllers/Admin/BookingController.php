<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return view('admin.bookings.index');
    }

    public function destroy(Booking $booking)
    {
        if($booking->delete()) {
            return redirect(route('admin.bookings.index'))->with('bookingDeleted', 'Запись была удалена.');
        }
        return redirect(route('admin.bookings.index'))->with('bookingError', 'Произошла ошибка.');
    }
}
