<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(): View
    {
        $appointments = Appointment::query()
            ->with(['user', 'vehicle', 'services', 'mechanic'])
            ->orderByDesc('scheduled_at')
            ->paginate(20);

        return view('garage.admin.appointments.index', compact('appointments'));
    }

    public function show(Appointment $appointment): View
    {
        $appointment->load(['user', 'vehicle', 'services', 'mechanic', 'workOrders']);

        $mechanics = User::query()->where('is_admin', true)->orderBy('name')->get();

        return view('garage.admin.appointments.show', compact('appointment', 'mechanics'));
    }

    public function update(Request $request, Appointment $appointment): RedirectResponse
    {
        $data = $request->validate([
            'status' => 'required|string|in:' . implode(',', [
                Appointment::STATUS_PENDING,
                Appointment::STATUS_CONFIRMED,
                Appointment::STATUS_CANCELLED,
                Appointment::STATUS_COMPLETED,
            ]),
            'mechanic_id' => 'nullable|exists:users,id',
            'admin_notes' => 'nullable|string|max:4000',
        ]);

        if (! empty($data['mechanic_id'])) {
            $m = User::query()->findOrFail($data['mechanic_id']);
            if (! $m->isAdmin()) {
                return redirect()->back()->withErrors(['mechanic_id' => 'Назначить можно только сотрудника с правами администратора.']);
            }
        }

        $appointment->update([
            'status' => $data['status'],
            'mechanic_id' => $data['mechanic_id'] ?? null,
            'admin_notes' => $data['admin_notes'] ?? null,
        ]);

        return redirect()->route('admin.appointments.show', $appointment)->with('status', 'Запись обновлена.');
    }
}
