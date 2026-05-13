<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReviewModerationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(): View
    {
        $reviews = Review::query()
            ->with('user')
            ->orderByDesc('id')
            ->paginate(25);

        return view('garage.admin.reviews.index', compact('reviews'));
    }

    public function approve(Review $review): RedirectResponse
    {
        $review->update(['is_approved' => true]);

        return redirect()->route('admin.reviews.index')->with('status', 'Отзыв опубликован.');
    }

    public function destroy(Review $review): RedirectResponse
    {
        $review->delete();

        return redirect()->route('admin.reviews.index')->with('status', 'Отзыв удалён.');
    }
}
