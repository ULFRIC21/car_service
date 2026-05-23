<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SiteImage;
use Illuminate\Support\Collection;
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

        $imgs = SiteImage::pageUrls();
        $galleryItems = SiteImage::galleryItems();
        $promotions = new Collection();
        $reviews = new Collection();

        return view('welcome', compact('services', 'imgs', 'galleryItems', 'promotions', 'reviews'));
    }
}
