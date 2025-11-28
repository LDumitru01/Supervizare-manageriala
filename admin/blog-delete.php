<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../config/database.php';
requireAdminAuth();

$currentUser = getCurrentAdminUser();

// Get post ID from URL
$post_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($post_id === 0) {
    header('Location: blog-list.php');
    exit;
}

// Fetch post data to get image path
$stmt = $mysqli->prepare("SELECT * FROM blog_posts WHERE id = ?");
$stmt->bind_param('i', $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();
$stmt->close();

if (!$post) {
    header('Location: blog-list.php');
    exit;
}

// Handle deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Delete associated image file if exists
    if (!empty($post['image']) && file_exists(__DIR__ . '/../' . $post['image'])) {
        unlink(__DIR__ . '/../' . $post['image']);
    }
    
    // Delete from database
    $stmt = $mysqli->prepare("DELETE FROM blog_posts WHERE id = ?");
    $stmt->bind_param('i', $post_id);
    
    if ($stmt->execute()) {
        header('Location: blog-list.php?deleted=1');
        exit;
    } else {
        $error = 'Eroare la ștergerea articolului: ' . $stmt->error;
    }
    
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Șterge Articol - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-50 min-h-screen">
    <!-- Header -->
    <header class="bg-slate-800 border-b border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <a href="dashboard.php" class="text-slate-400 hover:text-white">← Dashboard</a>
                    <a href="blog-list.php" class="text-slate-400 hover:text-white">← Listă Articole</a>
                    <h1 class="text-xl font-bold">Șterge Articol</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-slate-400"><?= htmlspecialchars($currentUser['full_name']) ?></span>
                    <a href="logout.php" class="text-sm text-red-400 hover:text-red-300">Deconectare</a>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-2xl mx-auto py-10 px-4">
        <div class="bg-slate-800 rounded-lg border border-slate-700 p-6">
            <h2 class="text-lg font-semibold text-red-400 mb-4">Confirmare ștergere</h2>
            
            <div class="mb-6 p-4 bg-slate-700/50 rounded-lg">
                <h3 class="font-medium text-white mb-2">Articolul care va fi șters:</h3>
                <p class="text-slate-300"><?= htmlspecialchars($post['title']) ?></p>
                <p class="text-sm text-slate-400 mt-1">
                    Creat: <?= date('d M Y, H:i', strtotime($post['created_at'])) ?>
                </p>
            </div>

            <?php if (isset($error)): ?>
                <div class="mb-4 rounded-lg bg-red-900/40 border border-red-500 px-4 py-3 text-sm">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <div class="bg-yellow-900/20 border border-yellow-600 rounded-lg p-4 mb-6">
                <p class="text-yellow-200 text-sm">
                    <strong>Atenție:</strong> Această acțiune este permanentă și nu poate fi anulată. 
                    Articolul și orice imagine asociată vor fi șterse definitiv.
                </p>
            </div>

            <form method="post" class="flex space-x-4">
                <button type="submit" 
                        class="px-5 py-2.5 rounded-full bg-red-600 text-white text-sm font-semibold hover:bg-red-500">
                    Confirmă ștergerea
                </button>
                <a href="blog-list.php" 
                   class="px-5 py-2.5 rounded-full bg-slate-600 text-white text-sm font-semibold hover:bg-slate-500">
                    Anulează
                </a>
            </form>
        </div>
    </main>
</body>
</html>