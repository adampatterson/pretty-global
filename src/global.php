<?php

try {
    if (! function_exists('prettyglobal')) {
        /**
         * Display a pretty, searchable phpinfo() page.
         *
         * @param  int  $what  The INFO_* constants bitmask, same as native phpinfo().
         */
        function prettyglobal(int $what = INFO_ALL): void
        {
            try {
                prettyphpinfo($what);
            } catch (\Throwable $e) {
                // If rendering fails, fallback to native phpinfo
                phpinfo($what);
            }
        }
    }

    if (! function_exists('ppi')) {
        /**
         * Display a pretty, searchable phpinfo() page.
         *
         * @param  int  $what  The INFO_* constants bitmask, same as native phpinfo().
         */
        function ppi(int $what = INFO_ALL): void
        {
            try {
                prettyphpinfo($what);
            } catch (\Throwable $e) {
                // If rendering fails, fallback to native phpinfo
                phpinfo($what);
            }
        }
    }
} catch (\Throwable $e) {
    // Silently fail so the main script can continue
}
