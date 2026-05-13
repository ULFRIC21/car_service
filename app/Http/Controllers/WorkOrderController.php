<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use Illuminate\View\View;

class WorkOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $this->authorize('viewAny', WorkOrder::class);

        $workOrders = WorkOrder::query()
            ->where('user_id', auth()->id())
            ->with(['vehicle', 'lines'])
            ->orderByDesc('id')
            ->paginate(15);

        return view('garage.work_orders.index', compact('workOrders'));
    }

    public function show(WorkOrder $workOrder): View
    {
        $this->authorize('view', $workOrder);

        $workOrder->load(['vehicle', 'appointment', 'lines.service', 'lines.part', 'mechanic']);

        return view('garage.work_orders.show', compact('workOrder'));
    }
}
