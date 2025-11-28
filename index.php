<!DOCTYPE html>
<html lang="ro" class="scroll-smooth">
<?php include __DIR__ . '/partials/head.php'; ?>

<body class="min-h-screen text-gray-100 bg-gradient-to-b from-[#020617] via-[#07152c] to-[#020617]">

    <?php include __DIR__ . '/partials/header.php'; ?>

    <?php include __DIR__ . '/partials/despre-mine.php'; ?>

    <?php include __DIR__ . '/partials/investitie.php'; ?>

    <main class="relative z-10">
        <?php include __DIR__ . '/partials/de-ce-acum.php'; ?>
        <?php include __DIR__ . '/partials/ce-este.php'; ?>
        <?php include __DIR__ . '/partials/pentru-cine.php'; ?>
        <?php include __DIR__ . '/partials/beneficii.php'; ?>
        <?php include __DIR__ . '/partials/cum-te-convingi.php'; ?>
        <?php include __DIR__ . '/partials/testimoniale.php'; ?>
        <?php include __DIR__ . '/partials/formular.php'; ?>
        <?php include __DIR__ . '/partials/blog.php'; ?>
        
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

    <script>
document.getElementById("contactForm").addEventListener("submit", async function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const responseBox = document.getElementById("responseMessage");

    responseBox.textContent = "";
    responseBox.className = "text-center text-sm mt-4";

    try {
        const res = await fetch("contact-form.php", { // ← aici
            method: "POST",
            body: formData
        });

        const data = await res.text();
        console.log("STATUS:", res.status);
        console.log("RESPONSE:", data);

        if (data.includes("success")) {
            responseBox.textContent = "✔ Mesaj trimis cu succes! Te voi contacta în scurt timp.";
            responseBox.classList.add("text-green-400", "font-semibold");
            form.reset();
        } else {
            responseBox.textContent = "⚠ A apărut o eroare. Te rog încearcă din nou.";
            responseBox.classList.add("text-red-400", "font-semibold");
        }
    } catch (error) {
        console.error("Eroare fetch:", error);
        responseBox.textContent = "❌ Eroare de conexiune. Reîncearcă.";
        responseBox.classList.add("text-red-400");
    }
});
</script>



</body>
</html>
