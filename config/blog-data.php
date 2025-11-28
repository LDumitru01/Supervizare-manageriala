<?php
require_once __DIR__ . '/database.php';

// luăm articolele din tabela blog_posts
$sql = "
    SELECT id, title, slug, excerpt, image, created_at
    FROM blog_posts
    WHERE is_published = 1
    ORDER BY created_at DESC
";

$result = $mysqli->query($sql);

if (!$result) {
    die('Eroare interogare blog_posts: ' . $mysqli->error);
}

$blogPosts = $result->fetch_all(MYSQLI_ASSOC);
