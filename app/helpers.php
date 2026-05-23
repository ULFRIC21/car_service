<?php

if (! function_exists('site_image')) {
    /**
     * URL локального файла из public/images (поддержка кириллицы в имени).
     */
    function site_image(string $filename): string
    {
        $encoded = implode('/', array_map('rawurlencode', explode('/', $filename)));
        $path = public_path('images/' . $filename);
        $version = is_file($path) ? (string) filemtime($path) : (string) time();

        return asset('images/' . $encoded) . '?v=' . $version;
    }
}

if (! function_exists('site_images')) {
    /**
     * @param  array<string, string>  $files
     * @return array<string, string>
     */
    function site_images(array $files): array
    {
        return array_map('site_image', $files);
    }
}
