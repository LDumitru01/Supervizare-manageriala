<?php
// admin/blog-add.php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';
requireAdminAuth();

$currentUser = getCurrentAdminUser();

$errors = [];
$success = null;

// dacă s-a trimis formularul
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title   = trim($_POST['title'] ?? '');
    $slug    = trim($_POST['slug'] ?? '');
    $excerpt = trim($_POST['excerpt'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $is_published = isset($_POST['is_published']) ? 1 : 0;

    if ($title === '') {
        $errors[] = 'Titlul este obligatoriu.';
    }

    if ($content === '') {
        $errors[] = 'Conținutul articolului este obligatoriu.';
    }

    if ($slug === '') {
        $slug = generateSlug($title);
    } else {
        $slug = generateSlug($slug);
    }

    // verificăm dacă slug-ul există deja
    if (empty($errors) && slugExists($mysqli, $slug)) {
        $slug .= '-' . time(); // facem unic
    }

    // upload imagine (opțional)
    $imagePath = null;
    if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../uploads/blog/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true);
        }

        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fileName = 'blog-' . time() . '-' . mt_rand(1000, 9999) . '.' . $ext;
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            // calea relativă, pentru frontend
            $imagePath = 'uploads/blog/' . $fileName;
        } else {
            $errors[] = 'Nu s-a putut încărca imaginea.';
        }
    }

    // dacă nu avem erori → inserăm în DB
    if (empty($errors)) {
        $stmt = $mysqli->prepare("
            INSERT INTO blog_posts (title, slug, excerpt, content, image, is_published, created_at, author_id)
            VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)
        ");

        $stmt->bind_param(
            'sssssii',
            $title,
            $slug,
            $excerpt,
            $content,
            $imagePath,
            $is_published,
            $currentUser['id']
        );

        if ($stmt->execute()) {
            $success = 'Articolul a fost adăugat cu succes.';
            // resetăm câmpurile formularului
            $title = $slug = $excerpt = $content = '';
            $is_published = 1;
        } else {
            $errors[] = 'Eroare la salvarea în baza de date: ' . $stmt->error;
        }

        $stmt->close();
    }
}
?>
<!doctype html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Admin – Adaugă articol</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-50 min-h-screen">
    <!-- Header -->
    <header class="bg-slate-800 border-b border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <a href="dashboard.php" class="text-slate-400 hover:text-white">← Dashboard</a>
                    <h1 class="text-xl font-bold">Adaugă Articol</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-slate-400"><?= htmlspecialchars($currentUser['full_name']) ?></span>
                    <a href="logout.php" class="text-sm text-red-400 hover:text-red-300">Deconectare</a>
                </div>
            </div>
        </div>
    </header>

<div class="max-w-4xl mx-auto py-10 px-4">

    <?php if (!empty($errors)): ?>
        <div class="mb-4 rounded-lg bg-red-900/40 border border-red-500 px-4 py-3 text-sm">
            <ul class="list-disc pl-5">
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="mb-4 rounded-lg bg-emerald-900/40 border border-emerald-500 px-4 py-3 text-sm">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" class="space-y-6 bg-slate-800/60 p-6 rounded-2xl border border-slate-700">
        <div>
            <label class="block text-sm font-medium mb-1">Titlu articol *</label>
            <input type="text" name="title"
                   value="<?= htmlspecialchars($title ?? '') ?>"
                   class="w-full rounded-lg bg-slate-900 border border-slate-600 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">
                Slug (URL) <span class="text-xs text-slate-400">(opțional, se generează din titlu dacă îl lași gol)</span>
            </label>
            <input type="text" name="slug"
                   value="<?= htmlspecialchars($slug ?? '') ?>"
                   class="w-full rounded-lg bg-slate-900 border border-slate-600 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Excerpt (rezumat scurt)</label>
            <textarea name="excerpt" rows="3"
                      class="w-full rounded-lg bg-slate-900 border border-slate-600 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500"><?= htmlspecialchars($excerpt ?? '') ?></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Conținut articol *</label>
            <textarea name="content" rows="8"
                      class="w-full rounded-lg bg-slate-900 border border-slate-600 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500"><?= htmlspecialchars($content ?? '') ?></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Imagine (opțional)</label>
            <input type="file" name="image"
                   class="block w-full text-sm text-slate-200 file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-500 file:px-4 file:py-2 file:text-sm file:font-semibold hover:file:bg-emerald-400">
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" id="is_published" name="is_published"
                   class="h-4 w-4"
                <?= !isset($is_published) || $is_published ? 'checked' : '' ?>>
            <label for="is_published" class="text-sm">Publicat (vizibil pe site)</label>
        </div>

        <div class="pt-2">
            <button type="submit"
                    class="px-5 py-2.5 rounded-full bg-emerald-500 text-slate-900 text-sm font-semibold hover:bg-emerald-400">
                Salvează articolul
            </button>
        </div>
    </form>
</div>
</body>
</html>
