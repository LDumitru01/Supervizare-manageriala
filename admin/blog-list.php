<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../config/database.php';
requireAdminAuth();

$currentUser = getCurrentAdminUser();

// Handle bulk actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bulk_action'])) {
    $bulk_action = $_POST['bulk_action'];
    $selected_posts = $_POST['selected_posts'] ?? [];
    
    if (!empty($selected_posts)) {
        $placeholders = str_repeat('?,', count($selected_posts) - 1) . '?';
        
        switch ($bulk_action) {
            case 'publish':
                $stmt = $mysqli->prepare("UPDATE blog_posts SET is_published = 1 WHERE id IN ($placeholders)");
                break;
            case 'unpublish':
                $stmt = $mysqli->prepare("UPDATE blog_posts SET is_published = 0 WHERE id IN ($placeholders)");
                break;
            case 'delete':
                $stmt = $mysqli->prepare("DELETE FROM blog_posts WHERE id IN ($placeholders)");
                break;
        }
        
        if (isset($stmt)) {
            $types = str_repeat('i', count($selected_posts));
            $stmt->bind_param($types, ...$selected_posts);
            $stmt->execute();
            $stmt->close();
        }
    }
    
    header('Location: blog-list.php');
    exit;
}

// Get all blog posts
$stmt = $mysqli->prepare("
    SELECT bp.*, au.full_name as author_name 
    FROM blog_posts bp 
    LEFT JOIN admin_users au ON bp.author_id = au.id 
    ORDER BY bp.created_at DESC
");
$stmt->execute();
$result = $stmt->get_result();
$posts = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionează Articole - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-50 min-h-screen">
    <!-- Header -->
    <header class="bg-slate-800 border-b border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <a href="dashboard.php" class="text-slate-400 hover:text-white">← Dashboard</a>
                    <h1 class="text-xl font-bold">Gestionează Articole</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-slate-400"><?= htmlspecialchars($currentUser['full_name']) ?></span>
                    <a href="logout.php" class="text-sm text-red-400 hover:text-red-300">Deconectare</a>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Actions -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex space-x-4">
                <a href="blog-add.php" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    + Articol Nou
                </a>
            </div>
            
            <div class="text-sm text-slate-400">
                <?= count($posts) ?> articole în total
            </div>
        </div>

        <!-- Bulk Actions -->
        <form method="post" class="mb-4 flex items-center space-x-4">
            <select name="bulk_action" class="bg-slate-800 border border-slate-600 text-white rounded-lg px-3 py-2 text-sm">
                <option value="">Acțiuni în masă</option>
                <option value="publish">Publică</option>
                <option value="unpublish">Setează ca ciornă</option>
                <option value="delete">Șterge</option>
            </select>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                Aplică
            </button>
        </form>

        <!-- Posts Table -->
        <div class="bg-slate-800 rounded-lg border border-slate-700 overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-700">
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">
                            <input type="checkbox" id="select-all" class="rounded bg-slate-700 border-slate-600">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">
                            Articol
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">
                            Autor
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">
                            Data
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">
                            Acțiuni
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    <?php if (empty($posts)): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-400">
                                Nu există articole încă.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($posts as $post): ?>
                            <tr class="hover:bg-slate-700/50">
                                <td class="px-6 py-4">
                                    <input type="checkbox" name="selected_posts[]" value="<?= $post['id'] ?>" class="post-checkbox rounded bg-slate-700 border-slate-600">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <?php if (!empty($post['image'])): ?>
                                            <img src="../<?= htmlspecialchars($post['image']) ?>" alt="" class="w-10 h-10 rounded object-cover">
                                        <?php endif; ?>
                                        <div>
                                            <div class="font-medium text-white">
                                                <?= htmlspecialchars($post['title']) ?>
                                            </div>
                                            <div class="text-sm text-slate-400">
                                                /<?= htmlspecialchars($post['slug']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-300">
                                    <?= htmlspecialchars($post['author_name'] ?? 'Necunoscut') ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-300">
                                    <?= date('d M Y', strtotime($post['created_at'])) ?>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $post['is_published'] ? 'bg-emerald-900 text-emerald-200' : 'bg-yellow-900 text-yellow-200' ?>">
                                        <?= $post['is_published'] ? 'Publicat' : 'Ciornă' ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="../blog-details.php?slug=<?= urlencode($post['slug']) ?>" target="_blank" class="text-blue-400 hover:text-blue-300">Vizualizează</a>
                                        <a href="blog-edit.php?id=<?= $post['id'] ?>" class="text-emerald-400 hover:text-emerald-300">Edit</a>
                                        <a href="blog-delete.php?id=<?= $post['id'] ?>" class="text-red-400 hover:text-red-300" onclick="return confirm('Sigur vrei să ștergi acest articol?')">Șterge</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        // Select all functionality
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.post-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Update bulk action form to include selected posts
        document.querySelector('form').addEventListener('submit', function(e) {
            const selectedPosts = Array.from(document.querySelectorAll('.post-checkbox:checked')).map(cb => cb.value);
            if (selectedPosts.length === 0) {
                e.preventDefault();
                alert('Selectează cel puțin un articol pentru acțiunea în masă.');
                return;
            }
            
            selectedPosts.forEach(postId => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'selected_posts[]';
                input.value = postId;
                this.appendChild(input);
            });
        });
    </script>
</body>
</html>