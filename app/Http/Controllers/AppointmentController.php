<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
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
            ->with('service')
            ->orderByDesc('scheduled_at')
            ->get();

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $user = auth()->user();
        $services = Service::where('is_active', true)->orderBy('name')->get();

        return view('appointments.create', compact('user', 'services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'last_name' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'patronymic' => 'nullable|string|max:100',
            'phone' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'scheduled_at' => 'required|date|after:now',
            'client_comment' => 'nullable|string|max:1000',
        ]);

        $user = auth()->user();
        $user->update([
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'patronymic' => $data['patronymic'] ?? null,
            'phone' => $data['phone'],
            'name' => User::buildFullName($data['last_name'], $data['first_name'], $data['patronymic'] ?? null),
        ]);

        $service = Service::where('is_active', true)->findOrFail($data['service_id']);

        $user->appointments()->create([
            'vehicle_id' => null,
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
