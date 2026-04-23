# Pretty Global Info

A standalone, "scoped" PHAR distribution of [stechstudio/phpinfo](https://github.com/stechstudio/phpinfo). This allows you to use
`prettyphpinfo()` globally in any PHP project on your machine without adding it as a composer dependency or worrying about version conflicts.

## The Concept

This project uses **PHP-Scoper** and **Box** to bundle the `prettyphpinfo` library into a single `.phar` file.

1. **Scoping**: Every class inside the PHAR is prefixed with
   `GlobalPrettyPhpinfo`. This ensures that if your local project also uses a different version of the same library (or its dependencies like Symfony components), they will not conflict.
2. **Global Loading**: By using the PHP `auto_prepend_file` configuration, the PHAR is loaded into every PHP script you run. The helper functions `prettyphpinfo()` and
   `items()` are exposed globally for immediate use.

## Installation

### 1. Download the PHAR

Download the latest `pretty.phar` from the [Releases](https://github.com/adampatterson/pretty-global/releases) page of this repository.

Move it to a permanent location on your system, for example:

```bash
mv pretty.phar /usr/local/bin/pretty.phar
```

### 2. Configure `php.ini`

To make `prettyphpinfo()` available in all your projects, you need to tell PHP to load it automatically.

1. Find your `php.ini` file:
   ```bash
   php --ini
   ```
2. Add or update the `auto_prepend_file` directive:
   ```ini
   auto_prepend_file = "/usr/local/bin/pretty.phar"
   ```
3. Restart your web server (Nginx, Apache, or Laravel Valet).

## Usage

Once installed, you can call `prettyphpinfo()` from any PHP file on your system, exactly like you would call the native `phpinfo()`.

```php
<?php

// This will now render the Pretty, searchable PHP Info page
prettyphpinfo();
```

Alternativly, you can also use `prettyglobal()`, or a short `ppi()`.

## Development & Building

If you want to build the PHAR yourself:

1. Clone the repository.
2. Install dependencies:
   ```bash
   composer install
   ```
3. Compile the PHAR:
   ```bash
   composer build
   ```
   *This runs `vendor/bin/box compile` behind the scenes.*

## How it was built

- **[Box](https://github.com/box-project/box)**: Used to bundle the code and dependencies into the PHAR.
- **[PHP-Scoper](https://github.com/humbug/php-scoper)**: Used to prefix namespaces to prevent global dependency conflicts.
- **GitHub Actions**: Automatically builds and attaches the `pretty.phar` to every new release tag.
