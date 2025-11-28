<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../config/database.php';
requireAdminRole('admin'); // Only admins can manage users

$currentUser = getCurrentAdminUser();
$errors = [];
$success = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_user'])) {
        // Add new user
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $full_name = trim($_POST['full_name'] ?? '');
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? 'editor';
        $is_active = isset($_POST['is_active']) ? 1 : 0;

        // Validation
        if (empty($username) || empty($email) || empty($full_name) || empty($password)) {
            $errors[] = 'Toate câmpurile sunt obligatorii.';
        } elseif (strlen($password) < 6) {
            $errors[] = 'Parola trebuie să aibă cel puțin 6 caractere.';
        } else {
            // Check if username or email already exists
            $stmt = $mysqli->prepare("SELECT COUNT(*) FROM admin_users WHERE username = ? OR email = ?");
            $stmt->bind_param('ss', $username, $email);
            $stmt->execute();
            $stmt->bind_result($userCount);
            $stmt->fetch();
            $stmt->close();

            if ($userCount > 0) {
                $errors[] = 'Numele de utilizator sau email-ul există deja.';
            } else {
                // Insert new user
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $mysqli->prepare("
                    INSERT INTO admin_users (username, email, password_hash, full_name, role, is_active)
                    VALUES (?, ?, ?, ?, ?, ?)
                ");
                $stmt->bind_param('sssssi', $username, $email, $password_hash, $full_name, $role, $is_active);
                
                if ($stmt->execute()) {
                    $success = 'Utilizatorul a fost adăugat cu succes.';
                } else {
                    $errors[] = 'Eroare la adăugarea utilizatorului: ' . $stmt->error;
                }
                $stmt->close();
            }
        }
    } elseif (isset($_POST['update_user'])) {
        // Update user
        $user_id = (int)$_POST['user_id'];
        $full_name = trim($_POST['full_name'] ?? '');
        $role = $_POST['role'] ?? 'editor';
        $is_active = isset($_POST['is_active']) ? 1 : 0;

        $stmt = $mysqli->prepare("
            UPDATE admin_users 
            SET full_name = ?, role = ?, is_active = ?, updated_at = NOW() 
            WHERE id = ?
        ");
        $stmt->bind_param('ssii', $full_name, $role, $is_active, $user_id);
        
        if ($stmt->execute()) {
            $success = 'Utilizatorul a fost actualizat cu succes.';
        } else {
            $errors[] = 'Eroare la actualizarea utilizatorului: ' . $stmt->error;
        }
        $stmt->close();
    } elseif (isset($_POST['delete_user'])) {
        // Delete user (cannot delete self)
        $user_id = (int)$_POST['user_id'];
        
        if ($user_id === $currentUser['id']) {
            $errors[] = 'Nu poți să-ți ștergi propriul cont.';
        } else {
            $stmt = $mysqli->prepare("DELETE FROM admin_users WHERE id = ?");
            $stmt->bind_param('i', $user_id);
            
            if ($stmt->execute()) {
                $success = 'Utilizatorul a fost șters cu succes.';
            } else {
                $errors[] = 'Eroare la ștergerea utilizatorului: ' . $stmt->error;
            }
            $stmt->close();
        }
    }
}

// Get all users
$stmt = $mysqli->prepare("SELECT * FROM admin_users ORDER BY created_at DESC");
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionează Utilizatori - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-50 min-h-screen">
    <!-- Header -->
    <header class="bg-slate-800 border-b border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <a href="dashboard.php" class="text-slate-400 hover:text-white">← Dashboard</a>
                    <h1 class="text-xl font-bold">Gestionează Utilizatori</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-slate-400"><?= htmlspecialchars($currentUser['full_name']) ?></span>
                    <a href="change-password.php" class="text-sm text-blue-400 hover:text-blue-300">Schimbă parola</a>
                    <a href="logout.php" class="text-sm text-red-400 hover:text-red-300">Deconectare</a>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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

        <!-- Add User Form -->
        <div class="bg-slate-800 rounded-lg border border-slate-700 p-6 mb-8">
            <h2 class="text-lg font-semibold mb-4">Adaugă Utilizator Nou</h2>
            <form method="post" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Nume utilizator *</label>
                    <input type="text" name="username" required
                           class="w-full rounded-lg bg-slate-900 border border-slate-600 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Email *</label>
                    <input type="email" name="email" required
                           class="w-full rounded-lg bg-slate-900 border border-slate-600 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Nume complet *</label>
                    <input type="text" name="full_name" required
                           class="w-full rounded-lg bg-slate-900 border border-slate-600 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Parolă *</label>
                    <input type="password" name="password" required minlength="6"
                           class="w-full rounded-lg bg-slate-900 border border-slate-600 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Rol</label>
                    <select name="role" class="w-full rounded-lg bg-slate-900 border border-slate-600 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="editor">Editor</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                
                <div class="flex items-center">
                    <input type="checkbox" id="is_active" name="is_active" checked
                           class="h-4 w-4 rounded bg-slate-900 border-slate-600">
                    <label for="is_active" class="ml-2 text-sm text-slate-300">Activ</label>
                </div>
                
                <div class="md:col-span-2">
                    <button type="submit" name="add_user"
                            class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-medium transition-colors">
                        Adaugă Utilizator
                    </button>
                </div>
            </form>
        </div>

        <!-- Users List -->
        <div class="bg-slate-800 rounded-lg border border-slate-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-700">
                <h2 class="text-lg font-semibold">Utilizatori Existenți</h2>
            </div>
            
            <div class="divide-y divide-slate-700">
                <?php foreach ($users as $user): ?>
                    <div class="px-6 py-4">
                        <form method="post" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            
                            <div class="md:col-span-2">
                                <div class="font-medium text-white"><?= htmlspecialchars($user['username']) ?></div>
                                <div class="text-sm text-slate-400"><?= htmlspecialchars($user['email']) ?></div>
                            </div>
                            
                            <div class="md:col-span-3">
                                <input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" 
                                       class="w-full rounded-lg bg-slate-900 border border-slate-600 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            </div>
                            
                            <div class="md:col-span-2">
                                <select name="role" class="w-full rounded-lg bg-slate-900 border border-slate-600 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                    <option value="editor" <?= $user['role'] === 'editor' ? 'selected' : '' ?>>Editor</option>
                                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                </select>
                            </div>
                            
                            <div class="md:col-span-2 flex items-center space-x-4">
                                <div class="flex items-center">
                                    <input type="checkbox" name="is_active" <?= $user['is_active'] ? 'checked' : '' ?>
                                           class="h-4 w-4 rounded bg-slate-900 border-slate-600">
                                    <span class="ml-2 text-sm text-slate-300">Activ</span>
                                </div>
                                
                                <div class="text-sm text-slate-400">
                                    <?= date('d M Y', strtotime($user['created_at'])) ?>
                                </div>
                            </div>
                            
                            <div class="md:col-span-3 flex space-x-2">
                                <button type="submit" name="update_user"
                                        class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded text-sm font-medium transition-colors">
                                    Actualizează
                                </button>
                                
                                <?php if ($user['id'] !== $currentUser['id']): ?>
                                    <button type="submit" name="delete_user"
                                            class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm font-medium transition-colors"
                                            onclick="return confirm('Sigur vrei să ștergi acest utilizator?')">
                                        Șterge
                                    </button>
                                <?php else: ?>
                                    <span class="px-3 py-1 bg-slate-600 text-slate-400 rounded text-sm font-medium">
                                        Contul tău
                                    </span>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
</body>
</html>