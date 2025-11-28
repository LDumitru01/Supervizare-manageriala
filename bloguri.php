<?php
require_once __DIR__ . '/config/blog-data.php';   // aici se populează $blogPosts din DB
require_once __DIR__ . '/partials/head.php';

?>

<main class="bg-[#050814] text-white">

    <!-- HERO BLOG - fundal cu imagine + titlu + breadcrumb -->
    <section class="relative h-64 md:h-72 flex items-center">
        <!-- Imagine de fundal -->
        <div class="absolute inset-0">
            <div class="w-full h-full bg-cover bg-center"
                 style="background-image: url('./Images/blog-hero.jpg');">
            </div>
            <!-- Overlay întunecat peste imagine -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-transparent"></div>
        </div>

        <!-- Conținut -->
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

            <!-- Dreapta: breadcrumb -->
            <div class="hidden sm:block text-sm text-white/80">
                <a href="index.php" class="hover:text-teal-400">Home</a>
                <span class="mx-1">/</span>
                <span>Blog</span>
            </div>
        </div>
    </section>

    <!-- GRID cu toate articolele -->
    <section class="max-w-6xl mx-auto px-4 py-16">
        <!-- Titlu centrat + subtitlu -->
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-sm font-semibold tracking-[0.2em] text-teal-400 mb-3">
                // ARTICOLE ȘI NOUTĂȚI
            </p>

            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Toate articolele de pe blog
            </h2>

            <p class="text-gray-400">
                Explorează toate articolele publicate – parcurge-le în ritmul tău,
                atunci când ai nevoie de clarificări, idei sau inspirație.
            </p>
        </div>

        <!-- GRID CARDURI -->
        <div class="grid gap-10 md:grid-cols-3">
            <?php foreach ($blogPosts as $post): ?>
                <article class="bg-[#0b1020] rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition">

                    <!-- Imagine articol -->
                    <?php if (!empty($post['image'])): ?>
                        <div class="w-full h-56">
                            <a href="blog-details.php?slug=<?= urlencode($post['slug']) ?>">
                                <img src="<?= htmlspecialchars($post['image']) ?>"
                                     alt="<?= htmlspecialchars($post['title']) ?>"
                                     class="w-full h-full object-cover">
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- Conținut card -->
                    <div class="p-5 flex flex-col h-full">

                        <?php if (!empty($post['created_at'])): ?>
                            <p class="text-xs text-gray-400 mb-1">
                                <?= date('d M, Y', strtotime($post['created_at'])) ?>
                            </p>
                        <?php endif; ?>

                        <h3 class="text-lg font-semibold mt-2 mb-2">
                            <a href="blog-details.php?slug=<?= urlencode($post['slug']) ?>"
                               class="hover:text-teal-400">
                                <?= htmlspecialchars($post['title']) ?>
                            </a>
                        </h3>

                        <p class="text-gray-300 text-sm mb-4 line-clamp-3">
                            <?= htmlspecialchars($post['excerpt']) ?>
                        </p>

                        <a href="blog-details.php?slug=<?= urlencode($post['slug']) ?>"
                           class="mt-auto inline-flex items-center text-teal-400 font-medium">
                            Citește articolul →
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
