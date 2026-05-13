<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Car;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->isAdmin()) {
            $orders = Order::with(['user', 'car', 'service'])->latest()->get();
        } else {
            $orders = Auth::user()->orders()->with(['car', 'service'])->latest()->get();
        }
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $cars = Auth::user()->cars;
        $services = Service::all();
        return view('orders.create', compact('cars', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'service_id' => 'required|exists:services,id',
            'description' => 'nullable|string',
            'scheduled_at' => 'required|date|after:now',
        ]);

        $car = Car::findOrFail($validated['car_id']);
        if ($car->user_id !== Auth::id()) {
            abort(403);
        }

        $service = Service::findOrFail($validated['service_id']);

        Auth::user()->orders()->create([
            'car_id' => $validated['car_id'],
            'service_id' => $validated['service_id'],
            'description' => $validated['description'],
            'total_price' => $service->price,
            'scheduled_at' => $validated['scheduled_at'],
            'status' => 'pending',
        ]);

        return redirect()->route('orders.index')->with('success', 'Заказ создан!');
    }

    public function show(Order $order)
    {
        if (!Auth::user()->isAdmin() && $order->user_id !== Auth::id()) {
            abort(403);
        }
        $order->load(['user', 'car', 'service']);
        return view('orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',
        ]);

        $order->status = $validated['status'];
        if ($validated['status'] === 'completed') {
            $order->completed_at = now();
        }
        $order->save();

        return redirect()->route('orders.show', $order)->with('success', 'Статус обновлён!');
    }
}
