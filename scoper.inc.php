<?php

return [
    'prefix'            => 'GlobalPrettyPhpinfo',

    // 1. Tell Scoper NOT to touch these files at all.
    // This keeps the HTML and CSS exactly as they are.
    'exclude-files'     => [
        'vendor/stechstudio/phpinfo/resources/template.php',
    ],

    // 2. Ensure your helpers are global
    'expose-functions'  => ['prettyphpinfo', 'items', 'prettyglobal', 'ppi'],
    'exclude-functions' => ['prettyphpinfo', 'items', 'prettyglobal', 'ppi'],

    'expose-global-constants' => false,
    'expose-global-classes'   => false,
    'expose-global-functions' => false,

    'patchers' => [
        function (string $filePath, string $prefix, string $content): string {
            // 1. Target the Autoloader files specifically
            if (str_ends_with($filePath, 'vendor/autoload.php') || str_contains($filePath, 'vendor/composer/')) {
                // This regex finds the unique Composer hash and prefixes it
                // It changes 'ComposerAutoloaderInit[hash]' to 'GlobalPrettyPhpinfoComposerAutoloaderInit[hash]'
                return preg_replace(
                    '/(ComposerAutoloaderInit)[a-z0-9]+/',
                    $prefix.'$0',
                    $content
                );
            }

            return $content;
        },
    ],
];
