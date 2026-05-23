<?php
/**
 * Копирует новые/обновлённые фото из /image в /public/images.
 * Запуск: php sync-images.php
 */
$src = __DIR__ . '/image';
$dst = __DIR__ . '/public/images';
if (! is_dir($dst)) {
    mkdir($dst, 0755, true);
}
foreach (scandir($src) as $file) {
    if ($file === '.' || $file === '..') {
        continue;
    }
    $from = $src . '/' . $file;
    if (! is_file($from)) {
        continue;
    }
    copy($from, $dst . '/' . $file);
    echo "OK {$file}\n";
}
