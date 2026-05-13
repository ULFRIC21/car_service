<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\CallbackRequest;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = $request->user();

        $stats = [
            'vehicles' => $user->vehicles()->count(),
            'upcoming_appointments' => $user->appointments()
                ->whereIn('status', [Appointment::STATUS_PENDING, Appointment::STATUS_CONFIRMED])
                ->where('scheduled_at', '>=', now())
                ->count(),
            'open_work_orders' => $user->workOrders()
                ->whereIn('status', [WorkOrder::STATUS_DRAFT, WorkOrder::STATUS_IN_PROGRESS])
                ->count(),
        ];

        if ($user->isAdmin()) {
            $stats['new_callbacks'] = CallbackRequest::query()->where('status', CallbackRequest::STATUS_NEW)->count();
            $stats['pending_appointments'] = Appointment::query()->where('status', Appointment::STATUS_PENDING)->count();
        }

        return view('home', compact('stats'));
    }
}
