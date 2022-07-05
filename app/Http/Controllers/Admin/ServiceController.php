<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceCreateFormRequest;
use App\Http\Requests\ServiceUpdateFormRequest;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function redirect;
use function view;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.services.index');
    }

    public function create()
    {
        $categories = ServiceCategory::all();
        return view('admin.services.create', compact('categories'));
    }

    public function store(ServiceCreateFormRequest $request)
    {
        $validated = $request->validated();
        $image = $request->file('image');
        $path = $image->store('services');
        $validated['image'] = $path;
        $service = Service::create($validated);
        if($service) {
            return redirect(route('admin.services.index'))->with([
                'serviceCreated' => 'Услуга успешно создана.'
            ]);
        }
        return redirect(route('admin.services.index'))->with([
            'serviceError' => 'Произошла ошибка.'
        ]);
    }

    public function edit(Service $service)
    {
        $categories = ServiceCategory::all();
        return view('admin.services.edit', compact('categories', 'service'));
    }

    public function update(ServiceUpdateFormRequest $request, Service $service)
    {
        $validated = $request->validated();
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('services');
            Storage::delete($service->image);
            $service->image = $path;
        }
        $service->name = $validated['name'];
        $service->description = $validated['description'];
        $service->price = $validated['price'];
        $service->service_category_id = $validated['service_category_id'];
        $service->save();
        return redirect(route('admin.services.index'))->with(['serviceUpdated' => 'Услуга была изменена.']);
    }

    public function destroy(Service $service)
    {
        if($service->delete()) {
            Storage::delete($service->image);
            return redirect(route('admin.services.index'))->with([
                'serviceDeleted' => 'Услуга была удалена.'
            ]);
        }
        return redirect(route('admin.services.index'))->with([
            'serviceError' => 'Произошла ошибка.'
        ]);
    }
}
