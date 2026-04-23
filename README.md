# Pretty Global Info

A standalone, "scoped" PHAR distribution of [stechstudio/phpinfo](https://github.com/stechstudio/phpinfo). This allows you to use
`prettyphpinfo()` globally in any PHP project on your machine without adding it as a composer dependency or worrying about version conflicts.

## The Concept

This project uses **PHP-Scoper** and **Box** to bundle the `prettyphpinfo` library into a single `.phar` file.

1. **Scoping**: Every class inside the PHAR is prefixed with `GlobalPrettyPhpinfo`. This ensures that if your local project also uses a different version of the same
   library (or its dependencies like Symfony components), they will not conflict.
2. **Global Loading**: By using the PHP `auto_prepend_file` configuration, the PHAR is loaded into every PHP script you run. The helper functions `prettyphpinfo()` and
   `items()` are exposed globally for immediate use.

> [!NOTE]
> If for any reason this conflicts with your own projects code, feel free to use `auto_append_file`.
> All functions are wrapped to prevent any errors from breaking your application.

## Installation

### 1. Download the PHAR

Download the latest `pretty.phar` from the [Releases](https://github.com/adampatterson/pretty-global/releases) page of this repository.

Copy it to a permanent location on your system, for example:

```bash
cp pretty.phar /usr/local/bin/pretty.phar
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

// Alternatively
prettyglobal();

// Or a short version
ppi();
```

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

4. Copy the PHAR to a permanent location on your system.
   ```bash
   cp pretty.phar /usr/local/bin/pretty.phar
   ```

## How it was built

- **[Box](https://github.com/box-project/box)**: Used to bundle the code and dependencies into the PHAR.
- **[PHP-Scoper](https://github.com/humbug/php-scoper)**: Used to prefix namespaces to prevent global dependency conflicts.
- **GitHub Actions**: Automatically builds and attaches the `pretty.phar` to every new release tag.

## Releasing an update

This project uses GitHub Actions to automate the release process. When you are ready to release a new version:

1. **Tag the release**: Create a new version tag (e.g., `1.0.1`).
   ```bash
   git tag 1.0.1
   ```
2. **Push the tag**: Push the tag to GitHub.
   ```bash
   git push origin 1.0.1
   ```

### What happens next?

- **Build & Release**: GitHub Actions will automatically compile the `pretty.phar`, create a new GitHub Release, and attach the PHAR to it.
- **Changelog**: Once the release is published, another workflow will automatically update the `CHANGELOG.md` with the release notes.

## GitHub Token Setup

By default, GitHub Actions provides an automatic `GITHUB_TOKEN`. For most cases, you **do not** need to generate a personal token.

### 1. Enable Workflow Permissions (Recommended)

In most cases, you only need to grant the default token write permissions:

1. Go to your repository on GitHub.
2. Click on **Settings** > **Actions** > **General**.
3. Under **Workflow permissions**, select **Read and write permissions**.
4. Click **Save**.

### 2. When to Generate a PAT (Optional)

You only need to generate a Personal Access Token (PAT) if:

- You need to trigger other workflows from the release action.
- You are hitting rate limits with the default token.
- You prefer using a dedicated service account.

If you decide you need one:

1. Go to your GitHub [Personal Access Tokens](https://github.com/settings/tokens) settings.
2. Click **Generate new token (classic)**.
3. Give it a description (e.g., `Pretty Global Release`).
4. Select the `repo` scope (all).
5. Click **Generate token** and copy the value.
6. Add it as a repository secret named `GH_TOKEN` under **Settings** > **Secrets and variables** > **Actions**.
