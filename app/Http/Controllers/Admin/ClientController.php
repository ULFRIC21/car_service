<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function markContacted(Request $request, User $user)
    {
        if ($user->role !== User::ROLE_CLIENT) {
            abort(404);
        }

        $user->update(['contacted_at' => now()]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Заявка «' . $user->full_name . '» отмечена как обработанная.');
    }
}
