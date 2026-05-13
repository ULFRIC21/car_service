<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\CallbackRequest;
use App\Models\Part;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(): View
    {
        $stats = [
            'users' => User::query()->count(),
            'services' => Service::query()->count(),
            'parts' => Part::query()->count(),
            'pending_appointments' => Appointment::query()->where('status', Appointment::STATUS_PENDING)->count(),
            'open_work_orders' => WorkOrder::query()->whereIn('status', [WorkOrder::STATUS_DRAFT, WorkOrder::STATUS_IN_PROGRESS])->count(),
            'new_callbacks' => CallbackRequest::query()->where('status', CallbackRequest::STATUS_NEW)->count(),
            'reviews_pending' => Review::query()->where('is_approved', false)->count(),
        ];

        return view('garage.admin.dashboard', compact('stats'));
    }
}
