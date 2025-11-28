<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../config/database.php';
requireAdminAuth();

// Get statistics
$stats = [];

// Total blog posts
$stmt = $mysqli->prepare("SELECT COUNT(*) FROM blog_posts");
$stmt->execute();
$stmt->bind_result($stats['total_posts']);
$stmt->fetch();
$stmt->close();

// Published posts
$stmt = $mysqli->prepare("SELECT COUNT(*) FROM blog_posts WHERE is_published = 1");
$stmt->execute();
$stmt->bind_result($stats['published_posts']);
$stmt->fetch();
$stmt->close();

// Draft posts
$stmt = $mysqli->prepare("SELECT COUNT(*) FROM blog_posts WHERE is_published = 0");
$stmt->execute();
$stmt->bind_result($stats['draft_posts']);
$stmt->fetch();
$stmt->close();

// Recent posts
$stmt = $mysqli->prepare("
    SELECT id, title, created_at, is_published 
    FROM blog_posts 
    ORDER BY created_at DESC 
    LIMIT 5
");
$stmt->execute();
$result = $stmt->get_result();
$recent_posts = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$currentUser = getCurrentAdminUser();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Supervizare Managerială</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-50 min-h-screen">
    <!-- Header -->
    <header class="bg-slate-800 border-b border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <h1 class="text-xl font-bold">Admin Panel</h1>
                    <span class="text-sm text-slate-400">Bun venit, <?= htmlspecialchars($currentUser['full_name']) ?></span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-slate-400"><?= $currentUser['role'] ?></span>
                    <a href="change-password.php" class="text-sm text-blue-400 hover:text-blue-300">Schimbă parola</a>
                    <a href="logout.php" class="text-sm text-red-400 hover:text-red-300">Deconectare</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-slate-800 rounded-lg p-6 border border-slate-700">
                <div class="flex items-center">
                    <div class="p-2 rounded-lg bg-blue-500/20">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9m0 0v3m0-3a2 2 0 012-2h2a2 2 0 012 2m-6 5v6m4-6v6"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-slate-400">Total Articole</p>
                        <p class="text-2xl font-bold text-white"><?= $stats['total_posts'] ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-slate-800 rounded-lg p-6 border border-slate-700">
                <div class="flex items-center">
                    <div class="p-2 rounded-lg bg-emerald-500/20">
                        <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-slate-400">Publicate</p>
                        <p class="text-2xl font-bold text-white"><?= $stats['published_posts'] ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-slate-800 rounded-lg p-6 border border-slate-700">
                <div class="flex items-center">
                    <div class="p-2 rounded-lg bg-yellow-500/20">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-slate-400">Ciorne</p>
                        <p class="text-2xl font-bold text-white"><?= $stats['draft_posts'] ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <a href="blog-add.php" class="bg-emerald-600 hover:bg-emerald-700 text-white p-4 rounded-lg text-center transition-colors">
                <div class="text-lg font-semibold">Adaugă Articol</div>
                <div class="text-sm opacity-80">Postare nouă pe blog</div>
            </a>
            
            <a href="blog-list.php" class="bg-blue-600 hover:bg-blue-700 text-white p-4 rounded-lg text-center transition-colors">
                <div class="text-lg font-semibold">Gestionează Articole</div>
                <div class="text-sm opacity-80">Vizualizează și editează</div>
            </a>
            
            <?php if ($currentUser['role'] === 'admin'): ?>
            <a href="users.php" class="bg-purple-600 hover:bg-purple-700 text-white p-4 rounded-lg text-center transition-colors">
                <div class="text-lg font-semibold">Utilizatori</div>
                <div class="text-sm opacity-80">Gestionează admini</div>
            </a>
            <?php endif; ?>
            
            <a href="../" target="_blank" class="bg-slate-600 hover:bg-slate-700 text-white p-4 rounded-lg text-center transition-colors">
                <div class="text-lg font-semibold">Vezi Site</div>
                <div class="text-sm opacity-80">Deschide site-ul</div>
            </a>
        </div>

        <!-- Recent Posts -->
        <div class="bg-slate-800 rounded-lg border border-slate-700">
            <div class="px-6 py-4 border-b border-slate-700">
                <h2 class="text-lg font-semibold">Articole Recente</h2>
            </div>
            <div class="divide-y divide-slate-700">
                <?php if (empty($recent_posts)): ?>
                    <div class="px-6 py-8 text-center text-slate-400">
                        Nu există articole încă.
                    </div>
                <?php else: ?>
                    <?php foreach ($recent_posts as $post): ?>
                        <div class="px-6 py-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="font-medium text-white"><?= htmlspecialchars($post['title']) ?></h3>
                                    <p class="text-sm text-slate-400">
                                        <?= date('d M Y, H:i', strtotime($post['created_at'])) ?>
                                        <span class="mx-2">•</span>
                                        <span class="<?= $post['is_published'] ? 'text-emerald-400' : 'text-yellow-400' ?>">
                                            <?= $post['is_published'] ? 'Publicat' : 'Ciornă' ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="blog-edit.php?id=<?= $post['id'] ?>" class="text-blue-400 hover:text-blue-300 text-sm">Edit</a>
                                    <a href="blog-delete.php?id=<?= $post['id'] ?>" class="text-red-400 hover:text-red-300 text-sm" onclick="return confirm('Sigur vrei să ștergi acest articol?')">Șterge</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>