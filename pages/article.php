<?php
require_once __DIR__ . '/../includes/article-data.php';
$slug = isset($_GET['slug']) ? preg_replace('/[^a-z0-9-]/', '', strtolower((string) $_GET['slug'])) : '';
$article = get_article_by_slug($slug);
require __DIR__ . '/../templates/article-template.php';
