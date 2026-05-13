<?php

namespace App\Http\Controllers;

use App\Models\CallbackRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CallbackRequestController extends Controller
{
    public function create(): View
    {
        return view('garage.public.callback');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'phone' => 'required|string|max:64',
            'message' => 'nullable|string|max:2000',
        ]);

        CallbackRequest::create(array_merge($data, ['status' => CallbackRequest::STATUS_NEW]));

        return redirect()->route('callback.create')->with('status', 'Заявка принята. Мы перезвоним вам.');
    }
}
