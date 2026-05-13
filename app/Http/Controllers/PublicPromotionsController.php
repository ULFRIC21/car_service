<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\View\View;

class PublicPromotionsController extends Controller
{
    public function index(): View
    {
        $promotions = Promotion::query()
            ->publicVisible()
            ->orderByDesc('starts_at')
            ->get();

        return view('garage.public.promotions', compact('promotions'));
    }
}
