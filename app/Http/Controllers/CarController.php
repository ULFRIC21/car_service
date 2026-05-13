<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cars = Auth::user()->cars()->latest()->get();
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'license_plate' => 'nullable|string|max:20',
            'vin' => 'nullable|string|max:17',
            'color' => 'nullable|string|max:50',
        ]);

        Auth::user()->cars()->create($validated);

        return redirect()->route('cars.index')->with('success', 'Автомобиль добавлен!');
    }

    public function edit(Car $car)
    {
        $this->authorize('update', $car);
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $this->authorize('update', $car);

        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'license_plate' => 'nullable|string|max:20',
            'vin' => 'nullable|string|max:17',
            'color' => 'nullable|string|max:50',
        ]);

        $car->update($validated);

        return redirect()->route('cars.index')->with('success', 'Автомобиль обновлён!');
    }

    public function destroy(Car $car)
    {
        $this->authorize('delete', $car);
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Автомобиль удалён!');
    }
}
