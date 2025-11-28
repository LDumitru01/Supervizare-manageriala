<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../config/database.php';
requireAdminAuth();

$currentUser = getCurrentAdminUser();
$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validation
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $errors[] = 'Toate câmpurile sunt obligatorii.';
    } elseif ($new_password !== $confirm_password) {
        $errors[] = 'Parolele noi nu se potrivesc.';
    } elseif (strlen($new_password) < 6) {
        $errors[] = 'Parola nouă trebuie să aibă cel puțin 6 caractere.';
    } else {
        // Verify current password
        $stmt = $mysqli->prepare("SELECT password_hash FROM admin_users WHERE id = ?");
        $stmt->bind_param('i', $currentUser['id']);
        $stmt->execute();
        $stmt->bind_result($current_hash);
        $stmt->fetch();
        $stmt->close();

        if (!password_verify($current_password, $current_hash)) {
            $errors[] = 'Parola curentă este incorectă.';
        } else {
            // Update password
            $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $mysqli->prepare("UPDATE admin_users SET password_hash = ?, updated_at = NOW() WHERE id = ?");
            $stmt->bind_param('si', $new_password_hash, $currentUser['id']);
            
            if ($stmt->execute()) {
                $success = 'Parola a fost schimbată cu succes.';
            } else {
                $errors[] = 'Eroare la actualizarea parolei: ' . $stmt->error;
            }
            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schimbă Parola - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-50 min-h-screen">
    <!-- Header -->
    <header class="bg-slate-800 border-b border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <a href="dashboard.php" class="text-slate-400 hover:text-white">← Dashboard</a>
                    <h1 class="text-xl font-bold">Schimbă Parola</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-slate-400"><?= htmlspecialchars($currentUser['full_name']) ?></span>
                    <a href="logout.php" class="text-sm text-red-400 hover:text-red-300">Deconectare</a>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-2xl mx-auto py-10 px-4">
        <?php if (!empty($errors)): ?>
            <div class="mb-6 rounded-lg bg-red-900/40 border border-red-500 px-4 py-3 text-sm">
                <ul class="list-disc pl-5">
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="mb-6 rounded-lg bg-emerald-900/40 border border-emerald-500 px-4 py-3 text-sm">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <div class="bg-slate-800 rounded-lg border border-slate-700 p-6">
            <form method="post" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Parola curentă *</label>
                    <input type="password" name="current_password" required
                           class="w-full rounded-lg bg-slate-900 border border-slate-600 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Parola nouă *</label>
                    <input type="password" name="new_password" required minlength="6"
                           class="w-full rounded-lg bg-slate-900 border border-slate-600 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    <p class="text-xs text-slate-400 mt-1">Minim 6 caractere</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Confirmă parola nouă *</label>
                    <input type="password" name="confirm_password" required minlength="6"
                           class="w-full rounded-lg bg-slate-900 border border-slate-600 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="pt-4">
                    <button type="submit"
                            class="px-5 py-2.5 rounded-full bg-emerald-500 text-slate-900 text-sm font-semibold hover:bg-emerald-400">
                        Schimbă parola
                    </button>
                    <a href="dashboard.php" 
                       class="ml-4 px-5 py-2.5 rounded-full bg-slate-600 text-white text-sm font-semibold hover:bg-slate-500">
                        Anulează
                    </a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>