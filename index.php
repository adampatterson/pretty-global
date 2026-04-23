<?php

// 1. Exit immediately if we are running in the CLI
if (PHP_SAPI === 'cli') {
    return;
}

try {
    // Load Autoloader
    require_once __DIR__.'/vendor/autoload.php';
} catch (\Throwable $e) {
    // Silently fail so the main script can continue
}
