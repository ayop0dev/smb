<?php
/**
 * Developer data loader.
 *
 * Sole responsibility: load, decode, validate and retrieve developer records
 * from data/developers.json. No HTML, no template copy, no writes to the
 * JSON file, no fallback to any archived/legacy data source.
 */
declare(strict_types=1);

/**
 * Load and decode data/developers.json, caching the result for the
 * remainder of the current request.
 */
function load_developers_data(): array
{
    static $cache = null;

    if ($cache !== null) {
        return $cache;
    }

    $path = __DIR__ . '/../data/developers.json';

    if (!is_file($path) || !is_readable($path)) {
        developer_data_fail('Developers data file missing or unreadable at: ' . $path);
    }

    $raw = file_get_contents($path);
    if ($raw === false) {
        developer_data_fail('Failed to read developers data file at: ' . $path);
    }

    try {
        $data = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
    } catch (\JsonException $e) {
        developer_data_fail('Failed to decode developers.json: ' . $e->getMessage());
    }

    if (!is_array($data) || !isset($data['developers']) || !is_array($data['developers'])) {
        developer_data_fail('developers.json did not decode to the expected structure (missing "developers" array).');
    }

    $cache = $data;
    return $cache;
}

/**
 * All developer records, in dataset order.
 */
function get_all_developers(): array
{
    $data = load_developers_data();
    return $data['developers'];
}

/**
 * A single developer record by slug, or null when no developer matches.
 * Returning null (rather than failing) lets the caller decide how to
 * respond — the shared template turns this into a 404.
 */
function get_developer_by_slug(string $slug): ?array
{
    $slug = trim($slug);
    if ($slug === '') {
        return null;
    }

    foreach (get_all_developers() as $developer) {
        if (($developer['slug'] ?? null) === $slug) {
            return $developer;
        }
    }

    return null;
}

/**
 * A single developer record by exact canonical name, or null when no developer matches.
 */
function get_developer_by_canonical_name(string $canonical_name): ?array
{
    $canonical_name = trim($canonical_name);
    if ($canonical_name === '') {
        return null;
    }

    foreach (get_all_developers() as $developer) {
        if (($developer['canonical_name'] ?? null) === $canonical_name) {
            return $developer;
        }
    }

    if (function_exists('developer_slug')) {
        $slug = developer_slug($canonical_name);
        foreach (get_all_developers() as $developer) {
            if (($developer['slug'] ?? null) === $slug) {
                return $developer;
            }
        }
    }

    return null;
}


/**
 * Controlled failure path for unrecoverable data problems (missing file,
 * unreadable file, malformed JSON). Logs the real cause internally and
 * returns a generic 500 to the client — no paths or stack traces exposed.
 */
function developer_data_fail(string $internal_message): never
{
    error_log('[developer-data] ' . $internal_message);

    if (!headers_sent()) {
        http_response_code(500);
        header('Content-Type: text/plain; charset=UTF-8');
    }

    echo "500 Internal Server Error\n";
    exit;
}
