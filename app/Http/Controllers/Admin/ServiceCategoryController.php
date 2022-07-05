<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceCategoryFormRequest;
use App\Models\ServiceCategory;
use function redirect;
use function view;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::paginate(10);
        return view('admin.service-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.service-categories.create');
    }

    public function store(ServiceCategoryFormRequest $request)
    {
        $validated = $request->validated();
        $category = ServiceCategory::create($validated);
        if($category) {
            return redirect(route('admin.service-categories.index'))->with([
                'categoryCreated' => 'Категория успешно создана.'
            ]);
        }
        return redirect(route('admin.service-categories.index'))->with([
            'categoryError' => 'Произошла ошибка.'
        ]);
    }

    public function edit(ServiceCategory $serviceCategory)
    {
        return view('admin.service-categories.edit', compact('serviceCategory'));
    }

    public function update(ServiceCategoryFormRequest $request, ServiceCategory $serviceCategory)
    {
        $validated = $request->validated();
        if($serviceCategory->update($validated)) {
            return redirect(route('admin.service-categories.index'))->with([
                'categoryUpdated' => 'Категория успешно изменена.'
            ]);
        }
        return redirect(route('admin.service-categories.index'))->with([
            'categoryError' => 'Произошла ошибка.'
        ]);
    }

    public function destroy(ServiceCategory $serviceCategory)
    {
        if($serviceCategory->delete()) {
            return redirect(route('admin.service-categories.index'))->with([
                'categoryDeleted' => 'Категория была удалена.'
            ]);
        }
        return redirect(route('admin.service-categories.index'))->with([
            'categoryError' => 'Произошла ошибка.'
        ]);
    }
}
