<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/partials/head.php';

// Dacă nu avem nici slug, nici id -> 404
if (!isset($_GET['slug']) && !isset($_GET['id'])) {
    http_response_code(404);
    echo "Articolul nu a fost găsit.";
    exit;
}

// 1. Luăm articolul curent (după slug sau id)
if (!empty($_GET['slug'])) {
    $slug = $_GET['slug'];

    $stmt = $mysqli->prepare("
        SELECT *
        FROM blog_posts
        WHERE slug = ? AND is_published = 1
        LIMIT 1
    ");
    $stmt->bind_param('s', $slug);
} else {
    $id = (int)($_GET['id'] ?? 0);

    $stmt = $mysqli->prepare("
        SELECT *
        FROM blog_posts
        WHERE id = ? AND is_published = 1
        LIMIT 1
    ");
    $stmt->bind_param('i', $id);
}

$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();
$stmt->close();

if (!$post) {
    http_response_code(404);
    echo "Articolul nu a fost găsit.";
    exit;
}

// Dată scurtă pentru badge (ex: 28 Nov)
$badgeDate = '';
if (!empty($post['created_at'])) {
    $badgeDate = date('d M', strtotime($post['created_at']));
}

// Dată normală pentru meta (ex: 28 Nov 2025)
$fullDate = '';
if (!empty($post['created_at'])) {
    $fullDate = date('d M Y', strtotime($post['created_at']));
}
?>

<main class="bg-[#0A0F1D] text-white min-h-screen">

    <!-- HERO: imagine + titlu + breadcrumb -->
    <section class="relative h-56 md:h-64 flex items-center">
        <div class="absolute inset-0">
            <div class="w-full h-full bg-cover bg-center scale-105"
                 style="background-image: url('./Images/blog-hero.jpg');"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-black/75 via-black/60 to-transparent"></div>
        </div>

        <div class="relative z-10 w-full max-w-6xl mx-auto px-4 flex items-center justify-between">
            <!-- Stânga: SERVICII + Blog -->
            <div>
                <p class="text-xs md:text-sm tracking-[0.25em] uppercase text-white/70 mb-2">
                    SERVICII
                </p>
                <h1 class="text-3xl md:text-4xl font-bold">
                    Blog
                </h1>
            </div>

            <!-- Dreapta: breadcrumb (fără titlu articol, cum ai cerut) -->
            <div class="text-sm text-white/80 text-center sm:text-right max-w-xs sm:max-w-none">
                <a href="index.php" class="hover:text-teal-400">Home</a>
                <span class="mx-1">/</span>
                <a href="bloguri.php" class="hover:text-teal-400">Blog</a>
            </div>
        </div>
    </section>

    <!-- CONTINUT articol + SIDEBAR -->
    <section class="max-w-6xl mx-auto px-4 py-16 grid gap-10 lg:grid-cols-[minmax(0,2.2fr),minmax(0,1fr)] items-start">

        <!-- STÂNGA: articolul -->
        <article
            class="min-h-screen text-white bg-gradient-to-b from-[#0C1222] to-[#0A0F1D]
                   rounded-3xl shadow-[0_25px_80px_rgba(0,0,0,0.75)] overflow-hidden border border-white/5">

            <!-- Imagine + badge dată -->
            <?php if (!empty($post['image'])): ?>
                <div class="relative">
                    <img src="<?= htmlspecialchars($post['image']) ?>"
                         alt="<?= htmlspecialchars($post['title']) ?>"
                         class="w-full max-h-[480px] object-cover">

                    <?php if ($badgeDate): ?>
                        <div
                            class="absolute top-5 left-5 bg-[#0B305E]/95 text-white text-xs font-semibold px-4 py-2 rounded-full shadow-lg">
                            <?= $badgeDate ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Conținut card articol -->
            <div class="px-8 py-7 md:px-10 md:py-8">

                <!-- META row -->
                <div class="flex flex-wrap items-center gap-4 text-[12px] text-white/60 mb-6">
                    <span class="inline-flex items-center gap-2">
                        <span class="text-teal-400 text-xs">●</span>
                        By Supervizare Managerială
                    </span>

                    <?php if (!empty($post['category'])): ?>
                        <span class="inline-flex items-center gap-2">
                            <span class="text-xs">🏷</span>
                            <?= htmlspecialchars($post['category']) ?>
                        </span>
                    <?php endif; ?>

                    <?php if ($fullDate): ?>
                        <span class="inline-flex items-center gap-2">
                            <span class="text-xs">🗓</span>
                            <?= $fullDate ?>
                        </span>
                    <?php endif; ?>
                </div>

                <!-- Titlu articol -->
                <h2 class="text-2xl md:text-3xl font-bold leading-tight mb-5 text-white">
                    <?= htmlspecialchars($post['title']) ?>
                </h2>

                <!-- Linie subtilă -->
                <div class="h-px w-16 bg-teal-400/70 mb-6"></div>

                <!-- Text articol -->
                <div
                    class="prose prose-invert max-w-none text-[16px] leading-8 prose-p:mb-4
                           prose-headings:mt-6 prose-headings:mb-3 prose-ul:ml-5 prose-ol:ml-5
                           prose-li:marker:text-teal-300">
                    <?php
                    // Dacă vrei să permiți HTML în conținut (ex: <strong>, <ul>, etc.),
                    // înlocuiește linia de mai jos cu:  echo nl2br($post['content']);
                    echo nl2br(htmlspecialchars($post['content']));
                    ?>
                </div>
            </div>
        </article>

        <!-- DREAPTA: sidebar „Ultimele noastre postări” -->
        <aside
            class="bg-[#060915] rounded-3xl shadow-[0_20px_70px_rgba(0,0,0,0.85)]
                   border border-white/5 p-6 md:p-7">
            <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                <span class="inline-block h-2 w-2 rounded-full bg-teal-400"></span>
                Ultimele noastre postări
            </h3>

            <div class="space-y-3">

                <?php
                $stmtLatest = $mysqli->prepare("
                    SELECT id, title, slug, image, created_at
                    FROM blog_posts
                    WHERE is_published = 1 AND id != ?
                    ORDER BY created_at DESC
                    LIMIT 4
                ");
                $stmtLatest->bind_param('i', $post['id']);
                $stmtLatest->execute();
                $resultLatest = $stmtLatest->get_result();

                if ($resultLatest->num_rows === 0): ?>
                    <p class="text-sm text-white/60">
                        Momentan nu există alte articole.
                    </p>
                <?php endif; ?>

                <?php while ($item = $resultLatest->fetch_assoc()): ?>
                    <a href="blog-details.php?slug=<?= urlencode($item['slug']) ?>"
                       class="flex items-center gap-3 py-2.5 border-b border-white/5 last:border-b-0 group">

                        <?php if (!empty($item['image'])): ?>
                            <div
                                class="w-14 h-14 rounded-xl overflow-hidden shrink-0 bg-slate-800/60
                                       ring-1 ring-white/10">
                                <img src="<?= htmlspecialchars($item['image']) ?>"
                                     alt="<?= htmlspecialchars($item['title']) ?>"
                                     class="w-full h-full object-cover group-hover:scale-[1.05] transition">
                            </div>
                        <?php endif; ?>

                        <div class="flex-1">
                            <?php if (!empty($item['created_at'])): ?>
                                <p class="text-[11px] text-white/50 mb-1">
                                    <?= date('d M Y', strtotime($item['created_at'])) ?>
                                </p>
                            <?php endif; ?>

                            <p
                                class="text-sm font-medium leading-snug text-white
                                       group-hover:text-teal-300 transition">
                                <?= htmlspecialchars($item['title']) ?>
                            </p>
                        </div>
                    </a>
                <?php endwhile;
                $stmtLatest->close();
                ?>
            </div>
        </aside>
    </section>
</main>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
