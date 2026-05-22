<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('name')->paginate(20);

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['image_path'] = $this->storeUploadedImage($request, $data['image_path'] ?? null);

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Услуга создана.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $this->validatedData($request);
        $data['image_path'] = $this->storeUploadedImage($request, $data['image_path'] ?? $service->image_path);

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Услуга обновлена.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Услуга удалена.');
    }

    private function validatedData(Request $request): array
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:5120',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:15|max:480',
            'is_active' => 'nullable|boolean',
        ]);

        return [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image_path' => $request->input('image_path'),
            'price' => $request->input('price'),
            'duration_minutes' => $request->input('duration_minutes'),
            'is_active' => $request->boolean('is_active'),
        ];
    }

    private function storeUploadedImage(Request $request, ?string $currentPath): ?string
    {
        if (! $request->hasFile('image')) {
            return $currentPath;
        }

        $file = $request->file('image');
        $name = $file->getClientOriginalName();
        $destination = public_path('images');

        if (! is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        $file->move($destination, $name);

        return $name;
    }
}
