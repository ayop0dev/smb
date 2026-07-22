<?php
/**
 * Project data loader.
 *
 * Sole responsibility: load, decode, validate and retrieve project records
 * from data/projects.json. No HTML, no template copy, no writes to the
 * JSON file, no fallback to any archived/legacy data source.
 */
declare(strict_types=1);

/**
 * Load and decode data/projects.json, caching the result for the
 * remainder of the current request.
 */
function load_projects_data(): array
{
    static $cache = null;

    if ($cache !== null) {
        return $cache;
    }

    $path = __DIR__ . '/../data/projects.json';

    if (!is_file($path) || !is_readable($path)) {
        project_data_fail('Projects data file missing or unreadable at: ' . $path);
    }

    $raw = file_get_contents($path);
    if ($raw === false) {
        project_data_fail('Failed to read projects data file at: ' . $path);
    }

    try {
        $data = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
    } catch (\JsonException $e) {
        project_data_fail('Failed to decode projects.json: ' . $e->getMessage());
    }

    if (!is_array($data) || !isset($data['projects']) || !is_array($data['projects'])) {
        project_data_fail('projects.json did not decode to the expected structure (missing "projects" array).');
    }

    $cache = $data;
    return $cache;
}

/**
 * All project records, in dataset order.
 */
function get_all_projects(): array
{
    $data = load_projects_data();
    return $data['projects'];
}

/**
 * A single project record by slug, or null when no project matches.
 * Returning null (rather than failing) lets the caller decide how to
 * respond — the shared template turns this into a 404.
 */
function get_project_by_slug(string $slug): ?array
{
    if (trim($slug) === '') {
        return null;
    }

    foreach (get_all_projects() as $project) {
        if (($project['slug'] ?? null) === $slug) {
            return $project;
        }
    }

    return null;
}

/**
 * Same data as get_all_projects(), but never triggers the hard-failure
 * path (project_data_fail() sends a page-wide HTTP 500 and exits, which is
 * correct for a page that IS one project, but wrong for a page that only
 * shows projects in one section alongside unrelated content). Returns null
 * when the dataset cannot be loaded or decoded so the caller can render a
 * local, controlled empty state instead of losing the whole page.
 */
function get_all_projects_safe(): ?array
{
    $path = __DIR__ . '/../data/projects.json';

    if (!is_file($path) || !is_readable($path)) {
        error_log('[project-data] get_all_projects_safe: file missing or unreadable at: ' . $path);
        return null;
    }

    $raw = file_get_contents($path);
    if ($raw === false) {
        error_log('[project-data] get_all_projects_safe: failed to read file at: ' . $path);
        return null;
    }

    try {
        $data = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
    } catch (\JsonException $e) {
        error_log('[project-data] get_all_projects_safe: failed to decode projects.json: ' . $e->getMessage());
        return null;
    }

    if (!is_array($data) || !isset($data['projects']) || !is_array($data['projects'])) {
        error_log('[project-data] get_all_projects_safe: unexpected structure (missing "projects" array).');
        return null;
    }

    return $data['projects'];
}

/**
 * All projects grouped by their exact `developer` value from projects.json.
 * Uses the safe loader (never a page-wide 500) since this is consumed by
 * developers.php, a general listing page where a data problem in one
 * section should not take down the rest of the page. Projects with an
 * empty developer value are ignored. Order within each group follows
 * dataset order; group keys follow first-seen order in the dataset.
 */
function get_projects_grouped_by_developer(): array
{
    static $cache = null;

    if ($cache !== null) {
        return $cache;
    }

    $grouped = [];
    foreach ((get_all_projects_safe() ?? []) as $project) {
        $developer = trim((string) ($project['developer'] ?? ''));
        if ($developer === '') {
            continue;
        }
        $grouped[$developer][] = $project;
    }

    $cache = $grouped;
    return $cache;
}

/**
 * Projects for one exact developer name, or an empty array when that
 * developer has no matching project in the current dataset.
 */
function get_projects_by_developer(string $developer): array
{
    $developer = trim($developer);
    if ($developer === '') {
        return [];
    }

    return get_projects_grouped_by_developer()[$developer] ?? [];
}

/**
 * Deterministic, URL-safe slug for a developer name, used to build the
 * shared anchor ID contract between developers.php (id="developer-{slug}")
 * and communities.php (developers.php#developer-{slug}). Both pages must
 * call this same function on the same canonical developer string so the
 * two always agree.
 */
function developer_slug(string $developer): string
{
    $slug = strtolower(trim($developer));
    $slug = str_replace('&', 'and', $slug);
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug) ?? '';
    return trim($slug, '-');
}

/**
 * Controlled failure path for unrecoverable data problems (missing file,
 * unreadable file, malformed JSON). Logs the real cause internally and
 * returns a generic 500 to the client — no paths or stack traces exposed.
 */
function project_data_fail(string $internal_message): never
{
    error_log('[project-data] ' . $internal_message);

    if (!headers_sent()) {
        http_response_code(500);
        header('Content-Type: text/plain; charset=UTF-8');
    }

    echo "500 Internal Server Error\n";
    exit;
}
