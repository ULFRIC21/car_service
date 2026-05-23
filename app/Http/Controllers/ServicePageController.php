<?php

namespace App\Http\Controllers;

use App\Support\SiteServices;

class ServicePageController extends Controller
{
    public function show(string $slug)
    {
        $service = SiteServices::resolve($slug);

        abort_if($service === null, 404);

        if ($service['type'] === 'category') {
            $firstPage = $service['category']['pages'][0] ?? null;

            if ($firstPage) {
                return redirect()->route('services.show', $firstPage['slug']);
            }
        }

        return view('pages.service.show', [
            'service' => $service,
            'categories' => SiteServices::categories(),
            'slug' => $slug,
        ]);
    }
}
