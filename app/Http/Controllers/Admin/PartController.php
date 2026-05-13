<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Part;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(): View
    {
        $parts = Part::query()->orderBy('sku')->paginate(25);

        return view('garage.admin.parts.index', compact('parts'));
    }

    public function create(): View
    {
        return view('garage.admin.parts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'sku' => 'required|string|max:64|unique:parts,sku',
            'name' => 'required|string|max:255',
            'stock_qty' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
        ]);

        Part::create($data);

        return redirect()->route('admin.parts.index')->with('status', 'Запчасть добавлена.');
    }

    public function edit(Part $part): View
    {
        return view('garage.admin.parts.edit', compact('part'));
    }

    public function update(Request $request, Part $part): RedirectResponse
    {
        $data = $request->validate([
            'sku' => 'required|string|max:64|unique:parts,sku,' . $part->id,
            'name' => 'required|string|max:255',
            'stock_qty' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $part->update($data);

        return redirect()->route('admin.parts.index')->with('status', 'Запчасть обновлена.');
    }

    public function destroy(Part $part): RedirectResponse
    {
        $part->delete();

        return redirect()->route('admin.parts.index')->with('status', 'Запчасть удалена.');
    }
}
