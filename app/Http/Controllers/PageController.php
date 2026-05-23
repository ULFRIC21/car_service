<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function corporate()
    {
        return view('pages.corporate');
    }

    public function reviews()
    {
        return view('pages.reviews');
    }

    public function contacts()
    {
        return view('pages.contacts');
    }
}
