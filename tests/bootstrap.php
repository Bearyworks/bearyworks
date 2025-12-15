<?php

use Bearyworks\Tests\App\AppKernel;

require_once __DIR__ . '/../vendor/autoload.php';

// Clean up cache before tests
$cacheDir = sys_get_temp_dir() . '/bearyworks/cache';
if (is_dir($cacheDir)) {
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($cacheDir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );
    foreach ($files as $fileinfo) {
        $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
        $todo($fileinfo->getRealPath());
    }
}

// Boot kernel for tests
$kernel = new AppKernel('test', true);
$kernel->boot();
