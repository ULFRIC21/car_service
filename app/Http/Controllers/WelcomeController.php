<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Review;
use App\Models\Service;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function index(): View
    {
        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->take(6)
            ->get();

        $promotions = Promotion::query()
            ->publicVisible()
            ->orderByDesc('starts_at')
            ->take(2)
            ->get();

        $reviews = Review::query()
            ->where('is_approved', true)
            ->with('user')
            ->latest()
            ->take(3)
            ->get();

        return view('welcome', compact('services', 'promotions', 'reviews'));
    }
}
