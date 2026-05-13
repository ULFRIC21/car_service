<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(): View
    {
        $services = Service::query()->orderBy('name')->paginate(20);

        return view('garage.admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('garage.admin.services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:8000',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:5|max:1440',
            'is_active' => 'sometimes|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        Service::create($data);

        return redirect()->route('admin.services.index')->with('status', 'Услуга создана.');
    }

    public function edit(Service $service): View
    {
        return view('garage.admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:8000',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:5|max:1440',
            'is_active' => 'sometimes|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $service->update($data);

        return redirect()->route('admin.services.index')->with('status', 'Услуга обновлена.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('status', 'Услуга удалена.');
    }
}
