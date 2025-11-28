<?php
// config/helpers.php - Funcții helper comune

/**
 * Generează slug din text
 */
function generateSlug(string $text): string {
    // scoatem spațiile la margini
    $text = trim($text);

    // înlocuim diacritice de bază (simplu)
    $map = [
        'ă' => 'a', 'â' => 'a', 'î' => 'i', 'ș' => 's', 'ş' => 's', 'ț' => 't', 'ţ' => 't',
        'Ă' => 'A', 'Â' => 'A', 'Î' => 'I', 'Ș' => 'S', 'Ş' => 'S', 'Ț' => 'T', 'Ţ' => 'T',
    ];
    $text = strtr($text, $map);

    // orice nu e literă/cifră devine "-"
    $text = preg_replace('~[^\\pL\\d]+~u', '-', $text);

    // eliminăm - la început/sfârșit
    $text = trim($text, '-');

    // litere mici
    $text = mb_strtolower($text, 'UTF-8');

    return $text ?: 'articol-' . time();
}

/**
 * Verifică dacă un slug există deja (excluzând un ID specific)
 */
function slugExists($mysqli, $slug, $exclude_id = null): bool {
    $count = 0;
    
    if ($exclude_id) {
        $stmt = $mysqli->prepare("SELECT COUNT(*) FROM blog_posts WHERE slug = ? AND id != ?");
        $stmt->bind_param('si', $slug, $exclude_id);
    } else {
        $stmt = $mysqli->prepare("SELECT COUNT(*) FROM blog_posts WHERE slug = ?");
        $stmt->bind_param('s', $slug);
    }
    
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    
    return $count > 0;
}