<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $this->authorize('viewAny', Vehicle::class);

        $vehicles = auth()->user()->vehicles()->orderByDesc('id')->paginate(15);

        return view('garage.vehicles.index', compact('vehicles'));
    }

    public function create(): View
    {
        $this->authorize('create', Vehicle::class);

        return view('garage.vehicles.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Vehicle::class);

        $data = $request->validate([
            'plate' => 'required|string|max:32',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'nullable|integer|min:1970|max:' . ((int) date('Y') + 1),
            'vin' => 'nullable|string|max:64',
            'mileage' => 'nullable|integer|min:0',
        ]);

        $request->user()->vehicles()->create($data);

        return redirect()->route('vehicles.index')->with('status', 'Автомобиль добавлен.');
    }

    public function show(Vehicle $vehicle): View
    {
        $this->authorize('view', $vehicle);

        return view('garage.vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle): View
    {
        $this->authorize('update', $vehicle);

        return view('garage.vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle): RedirectResponse
    {
        $this->authorize('update', $vehicle);

        $data = $request->validate([
            'plate' => 'required|string|max:32',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'nullable|integer|min:1970|max:' . ((int) date('Y') + 1),
            'vin' => 'nullable|string|max:64',
            'mileage' => 'nullable|integer|min:0',
        ]);

        $vehicle->update($data);

        return redirect()->route('vehicles.index')->with('status', 'Данные обновлены.');
    }

    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        $this->authorize('delete', $vehicle);

        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('status', 'Автомобиль удалён.');
    }
}
