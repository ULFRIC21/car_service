<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CallbackRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CallbackManageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(): View
    {
        $callbacks = CallbackRequest::query()->orderByDesc('id')->paginate(25);

        return view('garage.admin.callbacks.index', compact('callbacks'));
    }

    public function update(Request $request, CallbackRequest $callback_request): RedirectResponse
    {
        $data = $request->validate([
            'status' => 'required|string|in:' . CallbackRequest::STATUS_NEW . ',' . CallbackRequest::STATUS_DONE,
        ]);

        $callback_request->update($data);

        return redirect()->route('admin.callbacks.index')->with('status', 'Статус обновлён.');
    }
}
