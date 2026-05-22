<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'stats' => [
                'services' => Service::count(),
                'users' => User::count(),
                'appointments' => Appointment::count(),
                'pending' => Appointment::where('status', Appointment::STATUS_PENDING)->count(),
            ],
        ]);
    }
}
