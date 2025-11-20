<!DOCTYPE html>
<html lang="ro">
<?php include __DIR__ . '/partials/head.php'; ?>

<body class="min-h-screen text-gray-100 bg-gradient-to-b from-[#020617] via-[#07152c] to-[#020617]">

    <?php include __DIR__ . '/partials/header.php'; ?>

    <?php include __DIR__ . '/partials/investitie.php'; ?>

    <main class="relative z-10">
        <?php include __DIR__ . '/partials/de-ce-acum.php'; ?>
        <?php include __DIR__ . '/partials/ce-este.php'; ?>
        <?php include __DIR__ . '/partials/pentru-cine.php'; ?>
        <?php include __DIR__ . '/partials/beneficii.php'; ?>
        <?php include __DIR__ . '/partials/cum-te-convingi.php'; ?>
        <?php include __DIR__ . '/partials/testimoniale.php'; ?>
        <?php include __DIR__ . '/partials/formular.php'; ?>
    </main>

    <?php include __DIR__ . '/partials/footer.php'; ?>

    <script>
        // Meniul mobil
        const mobileToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileIcon = document.getElementById('mobile-menu-icon');

        if (mobileToggle) {
            mobileToggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                mobileIcon.classList.toggle('rotate-180');
            });
        }
    </script>

</body>
</html>
