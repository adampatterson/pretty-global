<?php


try {
    // Load Autoloader
    if (!class_exists('GlobalPrettyPhpinfo\STS\Phpinfo\Info')) {
        require_once __DIR__.'/vendor/autoload.php';
    }
} catch (\Throwable $e) {
    // Silently fail so the main script can continue
}

// 1. Exit immediately if we are running in the CLI.
// Functions are already defined via the autoloader above, so tests can use
// function_exists(). Only guard runtime side effects (e.g. auto-calling
// prettyglobal()) from running in CLI.
if (PHP_SAPI === 'cli') {
    return;
}

