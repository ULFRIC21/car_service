<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
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

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $stats = [
            'vehicles' => $user->vehicles()->count(),
            'upcoming_appointments' => $user->appointments()
                ->whereIn('status', [Appointment::STATUS_PENDING, Appointment::STATUS_CONFIRMED])
                ->where('scheduled_at', '>=', now())
                ->count(),
            'total_appointments' => $user->appointments()->count(),
        ];

        return view('home', compact('stats'));
    }
}
