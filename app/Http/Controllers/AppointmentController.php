<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $appointments = auth()->user()->appointments()
            ->with(['vehicle', 'service'])
            ->orderByDesc('scheduled_at')
            ->get();

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $vehicles = auth()->user()->vehicles()->orderBy('brand')->get();
        $services = Service::where('is_active', true)->orderBy('name')->get();

        if ($vehicles->isEmpty()) {
            return redirect()->route('vehicles.create')
                ->with('success', 'Сначала добавьте автомобиль.');
        }

        return view('appointments.create', compact('vehicles', 'services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'service_id' => 'required|exists:services,id',
            'scheduled_at' => 'required|date|after:now',
            'client_comment' => 'nullable|string|max:1000',
        ]);

        $vehicle = auth()->user()->vehicles()->findOrFail($data['vehicle_id']);
        $service = Service::where('is_active', true)->findOrFail($data['service_id']);

        auth()->user()->appointments()->create([
            'vehicle_id' => $vehicle->id,
            'service_id' => $service->id,
            'scheduled_at' => $data['scheduled_at'],
            'client_comment' => $data['client_comment'] ?? null,
            'status' => Appointment::STATUS_PENDING,
            'price_at_booking' => $service->price,
        ]);

        return redirect()->route('appointments.index')->with('success', 'Запись создана.');
    }

    public function destroy(Appointment $appointment)
    {
        if ($appointment->user_id !== auth()->id()) {
            abort(403);
        }

        if (! in_array($appointment->status, [Appointment::STATUS_PENDING, Appointment::STATUS_CONFIRMED], true)) {
            return back()->withErrors(['status' => 'Нельзя отменить запись в текущем статусе.']);
        }

        $appointment->update(['status' => Appointment::STATUS_CANCELLED]);

        return redirect()->route('appointments.index')->with('success', 'Запись отменена.');
    }
}
