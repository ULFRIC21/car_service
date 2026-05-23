<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SiteImage extends Model
{
    protected $fillable = [
        'group',
        'slot',
        'file_path',
        'alt',
        'sort_order',
    ];

    public function url(): string
    {
        return site_image($this->file_path);
    }

    /**
     * @return array<string, string> slot => URL
     */
    public static function pageUrls(): array
    {
        $rows = static::query()
            ->where('group', 'page')
            ->orderBy('sort_order')
            ->get();

        if ($rows->isEmpty()) {
            return collect(config('site.files', []))
                ->map(fn ($file) => site_image($file))
                ->all();
        }

        return $rows->pluck('file_path', 'slot')
            ->map(fn ($file) => site_image($file))
            ->all();
    }

    public static function galleryItems(): Collection
    {
        $rows = static::query()
            ->where('group', 'gallery')
            ->orderBy('sort_order')
            ->get();

        if ($rows->isEmpty()) {
            return collect(config('site.gallery', []))->map(fn ($item) => [
                'src' => site_image($item['file']),
                'alt' => $item['alt'],
            ]);
        }

        return $rows->map(fn (self $row) => [
            'src' => $row->url(),
            'alt' => $row->alt ?? '',
        ]);
    }

    public static function urlForSlot(string $slot, string $group = 'page'): ?string
    {
        if (\Illuminate\Support\Facades\Schema::hasTable('site_images')) {
            $row = static::query()->where('group', $group)->where('slot', $slot)->first();

            if ($row) {
                return $row->url();
            }
        }

        $file = config("site.files.{$slot}");

        return $file ? site_image($file) : asset('images/glav/slide1.jpg');
    }
}
