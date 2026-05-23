<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $clients = User::query()
            ->where('role', User::ROLE_CLIENT)
            ->orderByDesc('created_at')
            ->get();

        return view('admin.dashboard', [
            'pending' => $clients->whereNull('contacted_at')->values(),
            'contacted' => $clients->whereNotNull('contacted_at')->sortByDesc('contacted_at')->values(),
        ]);
    }
}
