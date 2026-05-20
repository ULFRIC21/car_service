<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vehicles = auth()->user()->vehicles()->orderBy('brand')->get();

        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'plate_number' => 'required|string|max:20',
            'vin' => 'nullable|string|max:17',
            'mileage' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        auth()->user()->vehicles()->create($data);

        return redirect()->route('vehicles.index')->with('success', 'Авто добавлено.');
    }

    public function edit(Vehicle $vehicle)
    {
        $this->authorizeVehicle($vehicle);

        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $this->authorizeVehicle($vehicle);

        $data = $request->validate([
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'plate_number' => 'required|string|max:20',
            'vin' => 'nullable|string|max:17',
            'mileage' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        $vehicle->update($data);

        return redirect()->route('vehicles.index')->with('success', 'Авто обновлено.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $this->authorizeVehicle($vehicle);

        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'Авто удалено.');
    }

    private function authorizeVehicle(Vehicle $vehicle): void
    {
        if ($vehicle->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
