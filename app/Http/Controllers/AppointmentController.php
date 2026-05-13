<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $this->authorize('viewAny', Appointment::class);

        $appointments = Appointment::query()
            ->where('user_id', auth()->id())
            ->with(['vehicle', 'services'])
            ->orderByDesc('scheduled_at')
            ->paginate(15);

        return view('garage.appointments.index', compact('appointments'));
    }

    public function create(): View
    {
        $this->authorize('create', Appointment::class);

        $vehicles = auth()->user()->vehicles()->orderBy('plate')->get();
        $services = Service::query()->where('is_active', true)->orderBy('name')->get();

        return view('garage.appointments.create', compact('vehicles', 'services'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Appointment::class);

        $data = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'scheduled_at' => 'required|date|after:now',
            'client_notes' => 'nullable|string|max:2000',
            'services' => 'required|array|min:1',
            'services.*' => 'integer|exists:services,id',
        ]);

        $vehicle = Vehicle::query()->findOrFail($data['vehicle_id']);
        $this->authorize('view', $vehicle);

        $appointment = Appointment::create([
            'user_id' => $request->user()->id,
            'vehicle_id' => $vehicle->id,
            'scheduled_at' => $data['scheduled_at'],
            'status' => Appointment::STATUS_PENDING,
            'client_notes' => $data['client_notes'] ?? null,
        ]);

        $appointment->services()->sync($data['services']);

        return redirect()->route('appointments.index')->with('status', 'Запись создана, ожидайте подтверждения.');
    }

    public function show(Appointment $appointment): View
    {
        $this->authorize('view', $appointment);

        $appointment->load(['vehicle', 'services', 'mechanic']);

        return view('garage.appointments.show', compact('appointment'));
    }

    public function cancel(Appointment $appointment): RedirectResponse
    {
        $this->authorize('cancel', $appointment);

        if (! in_array($appointment->status, [Appointment::STATUS_PENDING, Appointment::STATUS_CONFIRMED], true)) {
            return redirect()->back()->withErrors(['status' => 'Эту запись нельзя отменить.']);
        }

        $appointment->update(['status' => Appointment::STATUS_CANCELLED]);

        return redirect()->route('appointments.index')->with('status', 'Запись отменена.');
    }
}
