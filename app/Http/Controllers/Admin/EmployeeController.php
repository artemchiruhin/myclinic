<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeCreateFormRequest;
use App\Http\Requests\EmployeeUpdateFormRequest;
use App\Models\Employee;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        $categories = ServiceCategory::all();
        return view('admin.employees.create', compact('categories'));
    }

    public function store(EmployeeCreateFormRequest $request)
    {
        $validated = $request->validated();
        $image = $request->file('image');
        $path = $image->store('employees');
        $validated['image'] = $path;
        $employee = Employee::create($validated);
        if($employee) {
            return redirect(route('admin.employees.index'))->with('employeeCreated', 'Сотрудник успешно добавлен.');
        }
        return redirect(route('admin.employees.index'))->with('employeeError', 'Произошла ошибка.');
    }

    public function edit(Employee $employee)
    {
        $categories = ServiceCategory::all();
        return view('admin.employees.edit', compact('employee', 'categories'));
    }

    public function update(EmployeeUpdateFormRequest $request, Employee $employee)
    {
        $validated = $request->validated();
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('employees');
            Storage::delete($employee->image);
            $validated['image'] = $path;
        }
        if($employee->update($validated)) {
            return redirect(route('admin.employees.index'))->with('employeeUpdated', 'Сотрудник был изменен.');
        }
        return redirect(route('admin.employees.index'))->with('employeeError', 'Произошла ошибка.');
    }

    public function destroy(Employee $employee)
    {
        if($employee->delete()) {
            Storage::delete($employee->image);
            return redirect(route('admin.employees.index'))->with('employeeDeleted', 'Сотрудник был удалён.');
        }
        return redirect(route('admin.employees.index'))->with('employeeError', 'Произошла ошибка.');
    }
}
