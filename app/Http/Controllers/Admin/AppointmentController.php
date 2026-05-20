<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with(['user', 'vehicle', 'service', 'mechanic'])
            ->orderByDesc('scheduled_at');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $appointments = $query->paginate(20)->withQueryString();

        return view('admin.appointments.index', [
            'appointments' => $appointments,
            'statuses' => Appointment::statuses(),
        ]);
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['user', 'vehicle', 'service', 'mechanic']);

        return view('admin.appointments.show', [
            'appointment' => $appointment,
            'statuses' => Appointment::statuses(),
            'mechanics' => User::where('role', User::ROLE_MECHANIC)->orderBy('name')->get(),
        ]);
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(Appointment::statuses())),
            'mechanic_id' => 'nullable|exists:users,id',
            'admin_comment' => 'nullable|string|max:2000',
        ]);

        if (! empty($data['mechanic_id'])) {
            $mechanic = User::findOrFail($data['mechanic_id']);
            if (! $mechanic->isMechanic()) {
                return back()->withErrors(['mechanic_id' => 'Выбранный пользователь не мастер.']);
            }
        }

        $appointment->status = $data['status'];
        $appointment->mechanic_id = $data['mechanic_id'] ?? null;
        if (array_key_exists('admin_comment', $data)) {
            $appointment->admin_comment = $data['admin_comment'];
        }

        if ($data['status'] === Appointment::STATUS_COMPLETED) {
            $appointment->completed_at = now();
        }

        $appointment->save();

        return redirect()
            ->route('admin.appointments.show', $appointment)
            ->with('success', 'Запись обновлена.');
    }
}
