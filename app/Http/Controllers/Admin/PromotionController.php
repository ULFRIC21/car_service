<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PromotionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(): View
    {
        $promotions = Promotion::query()->orderByDesc('id')->paginate(20);

        return view('garage.admin.promotions.index', compact('promotions'));
    }

    public function create(): View
    {
        return view('garage.admin.promotions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'starts_at' => $request->input('starts_at') ?: null,
            'ends_at' => $request->input('ends_at') ?: null,
        ]);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string|max:8000',
            'is_active' => 'sometimes|boolean',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        Promotion::create($data);

        return redirect()->route('admin.promotions.index')->with('status', 'Акция создана.');
    }

    public function edit(Promotion $promotion): View
    {
        return view('garage.admin.promotions.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion): RedirectResponse
    {
        $request->merge([
            'starts_at' => $request->input('starts_at') ?: null,
            'ends_at' => $request->input('ends_at') ?: null,
        ]);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string|max:8000',
            'is_active' => 'sometimes|boolean',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $promotion->update($data);

        return redirect()->route('admin.promotions.index')->with('status', 'Акция обновлена.');
    }

    public function destroy(Promotion $promotion): RedirectResponse
    {
        $promotion->delete();

        return redirect()->route('admin.promotions.index')->with('status', 'Акция удалена.');
    }
}
