<?php

namespace App\Support;

class SiteServices
{
    public static function categories(): array
    {
        return config('site_services.categories', []);
    }

    public static function resolve(string $slug): ?array
    {
        foreach (self::categories() as $category) {
            if ($category['slug'] === $slug) {
                return [
                    'type' => 'category',
                    'slug' => $category['slug'],
                    'title' => $category['title'],
                    'image' => $category['image'],
                    'category' => $category,
                ];
            }

            foreach ($category['pages'] as $page) {
                if ($page['slug'] === $slug) {
                    return [
                        'type' => 'page',
                        'slug' => $page['slug'],
                        'title' => $page['title'],
                        'image' => $page['image'],
                        'category' => $category,
                    ];
                }
            }
        }

        return null;
    }
}
