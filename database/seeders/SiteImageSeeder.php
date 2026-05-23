<?php

namespace Database\Seeders;

use App\Models\SiteImage;
use Illuminate\Database\Seeder;

class SiteImageSeeder extends Seeder
{
    public function run()
    {
        foreach (config('site.files', []) as $slot => $file) {
            SiteImage::updateOrCreate(
                ['group' => 'page', 'slot' => $slot],
                ['file_path' => $file, 'sort_order' => 0]
            );
        }

        foreach (config('site.gallery', []) as $index => $item) {
            SiteImage::updateOrCreate(
                ['group' => 'gallery', 'slot' => 'item_' . $index],
                [
                    'file_path' => $item['file'],
                    'alt' => $item['alt'],
                    'sort_order' => $index,
                ]
            );
        }
    }
}
