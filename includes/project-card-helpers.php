<?php
/**
 * Shared project-card helper functions.
 *
 * Used by template-parts/project-card.php. Loaded via require_once so it is
 * safe to include from every page that renders a project-card grid
 * (communities.php, index.php, developer-template.php).
 */

/* Image precedence: hero.image, then the first valid gallery image, then the
   given fallback (never an external URL, never invented). */
function comm_project_card_image(array $project, string $fallback): array
{
    $candidates = [$project['hero']['image'] ?? ''];
    foreach (($project['gallery']['images'] ?? []) as $img) {
        $candidates[] = $img;
    }
    foreach ($candidates as $candidate) {
        $candidate = trim((string) $candidate);
        if ($candidate === '') {
            continue;
        }
        if (preg_match('#^([a-z]+:)?//#i', $candidate) === 1 || str_contains($candidate, '..')) {
            continue; // no external/protocol-relative URLs, no path traversal
        }
        return ['src' => $candidate, 'is_placeholder' => false];
    }
    return ['src' => $fallback, 'is_placeholder' => true];
}

/* Splits a hero.headline such as "Apartments, Duplexes and Penthouses" into
   individual, deduplicated display labels. Supports commas and "and";
   invents nothing — a headline with no separators just yields its own
   single label. */
function comm_parse_property_types(string $headline): array
{
    $headline = trim($headline);
    if ($headline === '') {
        return [];
    }
    $normalized = preg_replace('/\s+and\s+/i', ', ', $headline);
    $parts = array_map('trim', explode(',', $normalized));
    $parts = array_filter($parts, static fn (string $p): bool => $p !== '');
    return array_values(array_unique($parts));
}

/* Icon per property-type label. */
function comm_property_type_icon(string $label): string
{
    $l = strtolower($label);
    if (str_contains($l, 'apartment') || str_contains($l, 'penthouse') || str_contains($l, 'office')) {
        return '#i-building';
    }
    if (str_contains($l, 'retail')) {
        return '#i-bag';
    }
    return '#i-home'; // villas, townhouses, and any other residential label
}
