<?php

// 1. Include the PHAR — capture any output to verify nothing auto-executes
use GlobalPrettyPhpinfo\STS\Phpinfo\Info;

ob_start();
require_once __DIR__.'/../pretty.phar';
$output = ob_get_clean();

if ($output === '') {
    echo "✅ Success: No auto-execution occurred when loading the PHAR in CLI.\n";
} else {
    echo "❌ Error: Unexpected output was produced on load (guard may have failed):\n$output\n";
    exit(1);
}

// 2. Test if your custom function exists
if (function_exists('prettyglobal')) {
    echo "✅ Success: prettyglobal() is defined.\n";
} else {
    echo "❌ Error: prettyglobal() is NOT defined.\n";
    exit(1);
}

if (function_exists('ppi')) {
    echo "✅ Success: ppi() is defined.\n";
} else {
    echo "❌ Error: ppi() is NOT defined.\n";
    exit(1);
}

// 3. Test if scoping worked (check for the prefixed class)
if (class_exists(Info::class)) {
    echo "✅ Success: Internal classes are correctly prefixed.\n";
} else {
    echo "❌ Error: Could not find prefixed class. Scoping might have failed.\n";
    exit(1);
}

echo "All basic tests passed!\n";
