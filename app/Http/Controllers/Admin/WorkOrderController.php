<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Part;
use App\Models\Service;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\WorkOrder;
use App\Models\WorkOrderLine;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class WorkOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(): View
    {
        $workOrders = WorkOrder::query()
            ->with(['user', 'vehicle'])
            ->orderByDesc('id')
            ->paginate(20);

        return view('garage.admin.work_orders.index', compact('workOrders'));
    }

    public function create(Request $request): View
    {
        $users = User::query()->orderBy('name')->get();
        $vehicles = collect();

        if ($request->filled('user_id')) {
            $vehicles = Vehicle::query()
                ->where('user_id', $request->integer('user_id'))
                ->orderBy('plate')
                ->get();
        }

        return view('garage.admin.work_orders.create', compact('users', 'vehicles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'mechanic_id' => 'nullable|exists:users,id',
            'client_visible_notes' => 'nullable|string|max:4000',
            'internal_notes' => 'nullable|string|max:4000',
        ]);

        $vehicle = Vehicle::query()->findOrFail($data['vehicle_id']);
        if ((int) $vehicle->user_id !== (int) $data['user_id']) {
            throw ValidationException::withMessages(['vehicle_id' => 'Автомобиль не принадлежит выбранному клиенту.']);
        }

        if (! empty($data['appointment_id'])) {
            $ap = Appointment::query()->findOrFail($data['appointment_id']);
            if ((int) $ap->user_id !== (int) $data['user_id'] || (int) $ap->vehicle_id !== (int) $data['vehicle_id']) {
                throw ValidationException::withMessages(['appointment_id' => 'Запись не соответствует клиенту или автомобилю.']);
            }
        }

        if (! empty($data['mechanic_id'])) {
            $m = User::query()->findOrFail($data['mechanic_id']);
            if (! $m->isAdmin()) {
                throw ValidationException::withMessages(['mechanic_id' => 'Исполнитель должен быть администратором/мастером.']);
            }
        }

        $workOrder = WorkOrder::create([
            'user_id' => $data['user_id'],
            'vehicle_id' => $data['vehicle_id'],
            'appointment_id' => $data['appointment_id'] ?? null,
            'mechanic_id' => $data['mechanic_id'] ?? null,
            'status' => WorkOrder::STATUS_IN_PROGRESS,
            'client_visible_notes' => $data['client_visible_notes'] ?? null,
            'internal_notes' => $data['internal_notes'] ?? null,
            'opened_at' => now(),
        ]);

        return redirect()->route('admin.work-orders.show', $workOrder)->with('status', 'Заказ-наряд создан.');
    }

    public function storeFromAppointment(Appointment $appointment): RedirectResponse
    {
        if ($appointment->workOrders()->exists()) {
            return redirect()->route('admin.appointments.show', $appointment)->withErrors(['work_order' => 'По этой записи уже есть заказ-наряд.']);
        }

        $workOrder = WorkOrder::create([
            'user_id' => $appointment->user_id,
            'vehicle_id' => $appointment->vehicle_id,
            'appointment_id' => $appointment->id,
            'mechanic_id' => $appointment->mechanic_id,
            'status' => WorkOrder::STATUS_IN_PROGRESS,
            'opened_at' => now(),
        ]);

        $appointment->loadMissing('services');

        foreach ($appointment->services as $service) {
            $qty = 1;
            $unit = (float) $service->price;
            $total = round($unit * $qty, 2);
            WorkOrderLine::create([
                'work_order_id' => $workOrder->id,
                'service_id' => $service->id,
                'part_id' => null,
                'description' => $service->name,
                'quantity' => $qty,
                'unit_price' => $unit,
                'line_total' => $total,
            ]);
        }

        $workOrder->recalculateTotal();

        return redirect()->route('admin.work-orders.show', $workOrder)->with('status', 'Заказ-наряд создан из записи.');
    }

    public function show(WorkOrder $workOrder): View
    {
        $workOrder->load(['user', 'vehicle', 'appointment', 'lines.service', 'lines.part', 'mechanic']);

        $services = Service::query()->where('is_active', true)->orderBy('name')->get();
        $parts = Part::query()->orderBy('name')->get();
        $mechanics = User::query()->where('is_admin', true)->orderBy('name')->get();

        return view('garage.admin.work_orders.show', compact('workOrder', 'services', 'parts', 'mechanics'));
    }

    public function update(Request $request, WorkOrder $workOrder): RedirectResponse
    {
        if (! $workOrder->isEditableByAdmin()) {
            return redirect()->back()->withErrors(['status' => 'Заказ закрыт для редактирования.']);
        }

        $data = $request->validate([
            'status' => 'required|string|in:' . implode(',', [
                WorkOrder::STATUS_DRAFT,
                WorkOrder::STATUS_IN_PROGRESS,
                WorkOrder::STATUS_COMPLETED,
                WorkOrder::STATUS_CANCELLED,
            ]),
            'mechanic_id' => 'nullable|exists:users,id',
            'client_visible_notes' => 'nullable|string|max:4000',
            'internal_notes' => 'nullable|string|max:4000',
        ]);

        if (! empty($data['mechanic_id'])) {
            $m = User::query()->findOrFail($data['mechanic_id']);
            if (! $m->isAdmin()) {
                return redirect()->back()->withErrors(['mechanic_id' => 'Исполнитель должен быть администратором/мастером.']);
            }
        }

        $workOrder->update([
            'status' => $data['status'],
            'mechanic_id' => $data['mechanic_id'] ?? null,
            'client_visible_notes' => $data['client_visible_notes'] ?? null,
            'internal_notes' => $data['internal_notes'] ?? null,
            'completed_at' => $data['status'] === WorkOrder::STATUS_COMPLETED ? ($workOrder->completed_at ?? now()) : null,
        ]);

        if ($data['status'] === WorkOrder::STATUS_COMPLETED && $workOrder->appointment) {
            $workOrder->appointment->update(['status' => Appointment::STATUS_COMPLETED]);
        }

        return redirect()->route('admin.work-orders.show', $workOrder)->with('status', 'Заказ-наряд обновлён.');
    }

    public function storeLine(Request $request, WorkOrder $workOrder): RedirectResponse
    {
        if (! $workOrder->isEditableByAdmin()) {
            return redirect()->back()->withErrors(['status' => 'Нельзя добавлять строки в завершённый заказ.']);
        }

        $data = $request->validate([
            'line_type' => 'required|string|in:service,part,custom',
            'service_id' => 'required_if:line_type,service|nullable|exists:services,id',
            'part_id' => 'required_if:line_type,part|nullable|exists:parts,id',
            'description' => 'required_if:line_type,custom|nullable|string|max:500',
            'quantity' => 'required|integer|min:1|max:9999',
            'unit_price' => 'required_if:line_type,custom|nullable|numeric|min:0',
        ]);

        DB::transaction(function () use ($data, $workOrder) {
            if ($data['line_type'] === 'service') {
                $service = Service::query()->lockForUpdate()->findOrFail($data['service_id']);
                $qty = (int) $data['quantity'];
                $unit = (float) $service->price;
                $total = round($unit * $qty, 2);

                WorkOrderLine::create([
                    'work_order_id' => $workOrder->id,
                    'service_id' => $service->id,
                    'part_id' => null,
                    'description' => $service->name,
                    'quantity' => $qty,
                    'unit_price' => $unit,
                    'line_total' => $total,
                ]);
            } elseif ($data['line_type'] === 'part') {
                $part = Part::query()->lockForUpdate()->findOrFail($data['part_id']);
                $qty = (int) $data['quantity'];

                if ($part->stock_qty < $qty) {
                    throw ValidationException::withMessages(['part_id' => 'Недостаточно запчастей на складе.']);
                }

                $part->decrement('stock_qty', $qty);

                $unit = (float) $part->unit_price;
                $total = round($unit * $qty, 2);

                WorkOrderLine::create([
                    'work_order_id' => $workOrder->id,
                    'service_id' => null,
                    'part_id' => $part->id,
                    'description' => $part->name . ' (' . $part->sku . ')',
                    'quantity' => $qty,
                    'unit_price' => $unit,
                    'line_total' => $total,
                ]);
            } else {
                $qty = (int) $data['quantity'];
                $unit = (float) $data['unit_price'];
                $total = round($unit * $qty, 2);

                WorkOrderLine::create([
                    'work_order_id' => $workOrder->id,
                    'service_id' => null,
                    'part_id' => null,
                    'description' => $data['description'],
                    'quantity' => $qty,
                    'unit_price' => $unit,
                    'line_total' => $total,
                ]);
            }
        });

        $workOrder->recalculateTotal();

        return redirect()->route('admin.work-orders.show', $workOrder)->with('status', 'Строка добавлена.');
    }

    public function destroyLine(WorkOrder $workOrder, WorkOrderLine $work_order_line): RedirectResponse
    {
        $line = $work_order_line;

        if ((int) $line->work_order_id !== (int) $workOrder->id) {
            abort(404);
        }

        if (! $workOrder->isEditableByAdmin()) {
            return redirect()->back()->withErrors(['status' => 'Нельзя удалять строки в завершённом заказе.']);
        }

        DB::transaction(function () use ($line) {
            if ($line->part_id) {
                $part = Part::query()->lockForUpdate()->findOrFail($line->part_id);
                $part->increment('stock_qty', $line->quantity);
            }
            $line->delete();
        });

        $workOrder->recalculateTotal();

        return redirect()->route('admin.work-orders.show', $workOrder)->with('status', 'Строка удалена.');
    }

    public function complete(WorkOrder $workOrder): RedirectResponse
    {
        if (! $workOrder->isEditableByAdmin()) {
            return redirect()->back()->withErrors(['status' => 'Заказ уже завершён или отменён.']);
        }

        $workOrder->update([
            'status' => WorkOrder::STATUS_COMPLETED,
            'completed_at' => now(),
        ]);

        if ($workOrder->appointment) {
            $workOrder->appointment->update(['status' => Appointment::STATUS_COMPLETED]);
        }

        return redirect()->route('admin.work-orders.show', $workOrder)->with('status', 'Заказ-наряд закрыт.');
    }
}
