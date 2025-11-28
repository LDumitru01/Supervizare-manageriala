<?php
// blog.php – secțiunea de pe homepage
require_once __DIR__ . '/../config/blog-data.php';

// sortăm descrescător după dată (dacă nu vrei, poți să sari peste sort)
usort($blogPosts, callback: function($a, $b) {
    return strcmp($b['created_at'], $a['created_at']);
});

// luăm doar primele 2–3 articole pentru homepage
$latestPosts = array_slice($blogPosts, 0, 3);
?>

<section id="blog" class="panel-section shadow-xl backdrop-blur-xl p-6 sm:p-8 md:p-10 lg:p-12 min-h-[60vh] scroll-mt-32">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Titlu + subtitlu centrate -->
        <div class="text-center max-w-3xl mx-auto">
            <p class="text-sm font-semibold tracking-[0.2em] text-teal-400 mb-3">
                // ARTICOLE ȘI NOUTĂȚI
            </p>
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Cele mai recente știri<br class="hidden md:block">
                și articole de pe blog
            </h2>

            <a href="bloguri.php"
               class="inline-flex items-center mt-4 px-6 py-3 rounded-full bg-teal-400 text-black font-semibold hover:bg-teal-300 transition">
                Vezi toate articolele
            </a>
        </div>

        <!-- Grid cu carduri de blog -->
        <div class="mt-12 grid gap-8 md:grid-cols-3">
            <?php foreach ($latestPosts as $post): ?>
                <article class="bg-[#0b1020] rounded-2xl overflow-hidden shadow-lg flex flex-col">
                    <?php if (!empty($post['image'])): ?>
                        <div class="w-full h-56">
                            <img src="<?= htmlspecialchars($post['image']) ?>"
                                 alt="<?= htmlspecialchars($post['title']) ?>"
                                 class="w-full h-full object-cover">
                        </div>
                    <?php endif; ?>

                    <div class="p-5 flex flex-col flex-1">
                        <p class="text-xs text-gray-400 mb-1">
                            <?php if (!empty($post['created_at'])): ?>
                                <?= date('d M, Y', strtotime($post['created_at'])) ?>
                            <?php endif; ?>
                        </p>
                        <h3 class="text-lg font-semibold mb-2 leading-snug">
                            <a href="blog-details.php?slug=<?= urlencode($post['slug']) ?>"
                               class="hover:text-teal-400">
                                <?= htmlspecialchars($post['title']) ?>
                            </a>
                        </h3>
                        <p class="text-sm text-gray-300 line-clamp-3 mb-3">
                            <?= htmlspecialchars($post['excerpt']) ?>
                        </p>

                        <a href="blog-details.php?slug=<?= urlencode($post['slug']) ?>"
                           class="mt-auto inline-flex items-center text-teal-400 text-sm font-medium">
                            Citește articolul
                            <span class="ml-1 text-base">→</span>
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
