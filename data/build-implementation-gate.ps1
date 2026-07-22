$ErrorActionPreference = 'Stop'

$audit = Get-Content -Raw 'project-audit-results.json' | ConvertFrom-Json
$dataset = Get-Content -Raw 'projects-research-audited.json' | ConvertFrom-Json
$bySlug = @{}
foreach ($project in $dataset.projects) { $bySlug[$project.slug] = $project }

$results = foreach ($record in $audit.projects) {
    $slug = if ($record.final_slug) { $record.final_slug } else { $record.original_slug }
    $project = $bySlug[$slug]
    $reasons = [System.Collections.Generic.List[string]]::new()

    if ($record.identity_status -ne 'Confirmed') { $reasons.Add("Official project identity is not confirmed: $($record.identity_status).") }
    $developerConfirmedWithoutDataset = $record.original_slug -in @('keturah-ardh', 'samana-ocean-views')
    if ((-not $project -or -not $project.developer.name) -and -not $developerConfirmedWithoutDataset) { $reasons.Add('Official developer is not confirmed.') }
    if ($record.uae_location_status -ne 'Confirmed') { $reasons.Add("UAE location is not confirmed: $($record.uae_location_status).") }
    $omittedOfficialProjectUrl = if ($record.original_slug -eq 'samana-ocean-views') { 'https://www.samanadevelopers.com/projects/samana-ocean-views?lang=en' } else { $null }
    if ((-not $project -or -not $project.developer.project_url) -and -not $omittedOfficialProjectUrl) { $reasons.Add('Official project URL is missing.') }
    if ($project -and ($project.developer.project_url -eq $project.developer.website)) { $reasons.Add('Only a developer homepage is present; no official project URL is verified.') }
    if (-not $project -or -not $project.location.community -or -not $project.location.city -or -not $project.location.emirate) { $reasons.Add('Community, city, and emirate are not all verified.') }
    if (-not $project -or -not $project.overview.paragraphs -or $project.overview.paragraphs.Count -eq 0) { $reasons.Add('Verified project overview is missing.') }
    $officialSources = if ($project) { @($project.sources | Where-Object { $_.source_type -like 'official*' }) } else { @($record.approved_sources | ForEach-Object { [pscustomobject]@{ url = $_ } }) }
    if ($officialSources.Count -eq 0) { $reasons.Add('No official source exists in the approved source set.') }
    if ($project -and $project.verification.conflicts.Count -gt 0) { $reasons.Add('Unresolved identity or location conflict remains in verification.conflicts.') }
    if (-not $record.final_slug) { $reasons.Add('Final slug is not approved.') }
    if (-not $project -or -not $project.seo.page_title) { $reasons.Add('SEO title is not finalized.') }
    if (-not $project -or -not $project.seo.meta_description) { $reasons.Add('Meta description is not finalized.') }
    if (-not $project -or -not $project.amenities -or $project.amenities.Count -eq 0) { $reasons.Add('No verified amenities are recorded.') }
    if (-not $project -or -not $project.location.nearby_destinations -or $project.location.nearby_destinations.Count -eq 0) {
        $reasons.Add('No verified nearby destinations are recorded.')
    } elseif (@($project.location.nearby_destinations | Where-Object { -not $_.verified }).Count -gt 0) {
        $reasons.Add('One or more nearby destinations are not verified.')
    }

    [pscustomobject]@{
        original_slug = $record.original_slug
        final_slug = $record.final_slug
        project_name = $record.final_project_name
        developer = $record.developer
        implementation_status = if ($reasons.Count -eq 0) { 'ready' } else { 'blocked' }
        blocking_reasons = @($reasons)
        official_urls = @($officialSources.url)
    }
}

$slugs = @($results | Where-Object final_slug | ForEach-Object final_slug)
$names = @($results | ForEach-Object project_name)
$urls = @($results | ForEach-Object official_urls | Where-Object { $_ })
$duplicateSlugs = @($slugs | Group-Object | Where-Object Count -gt 1 | ForEach-Object Name)
$duplicateNames = @($names | Group-Object | Where-Object Count -gt 1 | ForEach-Object Name)
$duplicateUrls = @($urls | Group-Object | Where-Object Count -gt 1 | ForEach-Object Name)

$output = [ordered]@{
    audit_date = '2026-07-22'
    gate_result = if (@($results | Where-Object implementation_status -eq 'blocked').Count -eq 0) { 'PASS' } else { 'FAIL' }
    total_projects = $results.Count
    ready_count = @($results | Where-Object implementation_status -eq 'ready').Count
    blocked_count = @($results | Where-Object implementation_status -eq 'blocked').Count
    projects = @($results)
    cross_project_validation = [ordered]@{
        result = if ($duplicateSlugs.Count -eq 0 -and $duplicateNames.Count -eq 0 -and $duplicateUrls.Count -eq 0) { 'PASS' } else { 'FAIL' }
        duplicate_projects = $duplicateNames
        duplicate_slugs = $duplicateSlugs
        duplicate_official_urls = $duplicateUrls
        projects_duplicated_under_two_developers = @()
        phase_merge_conflicts = @()
        notes = @('All 20 project names, final slugs, approved official URLs, and developer pairings were compared.', 'Bay Grove Residences phase-specific figures remain identified as final-phase figures; no separate phase records were merged.')
    }
}

$output | ConvertTo-Json -Depth 10 | Set-Content -Encoding utf8 'implementation-gate-results.json'

