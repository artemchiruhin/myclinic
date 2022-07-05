<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingServiceFormRequest;
use App\Models\Employee;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function show(Service $service)
    {
        $employees = Employee::where('service_category_id', $service->service_category_id)->get();
        return view('user.services.show', compact('service', 'employees'));
    }
}
