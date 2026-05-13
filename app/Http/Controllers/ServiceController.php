<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $services = Service::latest()->get();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }
        return view('services.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
        ]);

        Service::create($validated);

        return redirect()->route('services.index')->with('success', 'Услуга добавлена!');
    }

    public function edit(Service $service)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
        ]);

        $service->update($validated);

        return redirect()->route('services.index')->with('success', 'Услуга обновлена!');
    }

    public function destroy(Service $service)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Услуга удалена!');
    }
}
