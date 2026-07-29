<?php
/**
 * Local-preview router for PHP's built-in server.
 *
 * PHP's built-in server (`php -S`) does not read .htaccess, so it cannot
 * apply the flat-URL rewrites (e.g. /developers.php -> pages/developers.php)
 * that Apache applies in production. This router reproduces the same
 * effect for local development only — it is never used by Apache/production,
 * which continues to rely solely on .htaccess.
 *
 * Usage: php -S localhost:8000 router.php
 */
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$name = preg_replace('/\.php$/', '', ltrim($uri, '/'));

if ($name === '' || $name === 'index') {
    return false; // let the built-in server serve index.php / static assets normally
}

if (!preg_match('/^[a-z0-9-]+$/', $name)) {
    return false; // not a flat top-level URL this router handles — serve as-is
}

foreach (['pages', 'developers', 'projects'] as $dir) {
    $path = __DIR__ . "/$dir/$name.php";
    if (is_file($path)) {
        require $path;
        return true;
    }
}

return false; // no match — let the built-in server 404 or serve a real static file
