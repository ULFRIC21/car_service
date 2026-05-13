<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\WorkOrder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $this->authorize('viewAny', Review::class);

        $reviews = Review::query()
            ->where('user_id', auth()->id())
            ->with('workOrder')
            ->orderByDesc('id')
            ->paginate(15);

        return view('garage.reviews.index', compact('reviews'));
    }

    public function create(Request $request): View
    {
        $this->authorize('create', Review::class);

        $workOrderId = $request->query('work_order_id');
        $workOrder = null;

        if ($workOrderId) {
            $workOrder = WorkOrder::query()->find($workOrderId);
            if ($workOrder) {
                $this->authorize('view', $workOrder);
                if ($workOrder->status !== WorkOrder::STATUS_COMPLETED) {
                    $workOrder = null;
                }
            }
        }

        $completedOrders = WorkOrder::query()
            ->where('user_id', auth()->id())
            ->where('status', WorkOrder::STATUS_COMPLETED)
            ->orderByDesc('id')
            ->get();

        return view('garage.reviews.create', compact('workOrder', 'completedOrders'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Review::class);

        $data = $request->validate([
            'work_order_id' => 'nullable|exists:work_orders,id',
            'rating' => 'required|integer|min:1|max:5',
            'body' => 'nullable|string|max:4000',
        ]);

        if (! empty($data['work_order_id'])) {
            $wo = WorkOrder::query()->findOrFail($data['work_order_id']);
            $this->authorize('view', $wo);
            if ($wo->status !== WorkOrder::STATUS_COMPLETED) {
                return redirect()->back()->withErrors(['work_order_id' => 'Отзыв можно оставить только по завершённому заказу.'])->withInput();
            }
        }

        Review::create([
            'user_id' => $request->user()->id,
            'work_order_id' => $data['work_order_id'] ?? null,
            'rating' => $data['rating'],
            'body' => $data['body'] ?? null,
            'is_approved' => false,
        ]);

        return redirect()->route('client.reviews.index')->with('status', 'Отзыв отправлен на модерацию.');
    }
}
