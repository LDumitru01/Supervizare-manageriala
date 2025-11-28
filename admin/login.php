<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// Redirect if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Te rog completează ambele câmpuri.';
    } else {
        // Verify user credentials
        $stmt = $mysqli->prepare("
            SELECT id, username, email, password_hash, full_name, role, is_active
            FROM admin_users
            WHERE username = ? AND is_active = 1
        ");
        
        if ($stmt === false) {
            $error = 'Eroare de sistem. Tabela admin_users nu există. Verifică setup-database.sql.';
        } else {
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            $stmt->close();

            if ($user && password_verify($password, $user['password_hash'])) {
                // Login successful
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_user_id'] = $user['id'];
                $_SESSION['admin_username'] = $user['username'];
                $_SESSION['admin_full_name'] = $user['full_name'];
                $_SESSION['admin_role'] = $user['role'];
                
                // Update last login
                $updateStmt = $mysqli->prepare("UPDATE admin_users SET updated_at = NOW() WHERE id = ?");
                if ($updateStmt) {
                    $updateStmt->bind_param('i', $user['id']);
                    $updateStmt->execute();
                    $updateStmt->close();
                }

                header('Location: dashboard.php');
                exit;
            } else {
                $error = 'Nume de utilizator sau parolă incorectă.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Supervizare Managerială</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        }
        .login-container {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="login-container rounded-2xl p-8 w-full max-w-md shadow-2xl">
        <!-- Logo/Header -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-white mb-2">Supervizare Managerială</h1>
            <p class="text-slate-400 text-sm">Panou de administrare</p>
        </div>

        <?php if ($error): ?>
            <div class="mb-4 rounded-lg bg-red-900/40 border border-red-500 px-4 py-3 text-sm text-white">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form method="post" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Nume utilizator</label>
                <input type="text" 
                       name="username" 
                       value="<?= htmlspecialchars($username) ?>" 
                       required
                       class="w-full px-4 py-3 rounded-lg bg-slate-800 border border-slate-600 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200"
                       placeholder="Introdu numele de utilizator">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Parolă</label>
                <input type="password" 
                       name="password" 
                       required
                       class="w-full px-4 py-3 rounded-lg bg-slate-800 border border-slate-600 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200"
                       placeholder="Introdu parola">
            </div>

            <button type="submit" 
                    class="w-full py-3 px-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold rounded-lg hover:from-emerald-600 hover:to-teal-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-slate-900 transition-all duration-200 transform hover:scale-[1.02]">
                Autentificare
            </button>
        </form>

        <!-- Setup Instructions -->
        <!-- <div class="mt-6 p-4 bg-blue-900/20 rounded-lg border border-blue-700">
            <p class="text-xs text-blue-300 text-center mb-2">
                <strong>Prima utilizare?</strong>
            </p>
            <p class="text-xs text-blue-400 text-center mb-2">
                Execută fișierul <code class="text-emerald-400">admin/setup-database.sql</code> în phpMyAdmin<br>
                pentru a crea tabela utilizatorilor și contul de admin.
            </p>
            <p class="text-xs text-blue-300 text-center">
                <a href="SETUP-GUIDE.md" target="_blank" class="underline hover:text-blue-200">
                    Vezi ghidul complet de setup →
                </a>
            </p>
        </div> -->

        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-xs text-slate-500">
                &copy; <?= date('Y') ?> Supervizare Managerială
            </p>
        </div>
    </div>
</body>
</html>