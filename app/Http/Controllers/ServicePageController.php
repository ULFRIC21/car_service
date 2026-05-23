<?php

namespace App\Http\Controllers;

use App\Support\SiteServices;
use Illuminate\Http\Request;

class ServicePageController extends Controller
{
    public function show(string $slug)
    {
        $service = SiteServices::resolve($slug);

        abort_if($service === null, 404);

        return view('pages.service.show', [
            'service' => $service,
            'categories' => SiteServices::categories(),
            'slug' => $slug,
        ]);
    }
}
