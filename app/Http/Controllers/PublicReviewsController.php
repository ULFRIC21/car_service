<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\View\View;

class PublicReviewsController extends Controller
{
    public function index(): View
    {
        $reviews = Review::query()
            ->where('is_approved', true)
            ->with('user')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('garage.public.reviews', compact('reviews'));
    }
}
