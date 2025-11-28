<html>
<body>
<footer class="panel-section bg-[#050814]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 
                text-gray-500 flex flex-col items-center text-center space-y-4">

        <!-- LOGO MAI MARE -->
        <img src="./Images/LucruLogoTaiat.png" 
             alt="Logo Grigore Barladean"
             class="w-40 sm:w-48 h-auto object-contain drop-shadow-xl" />

            <div class="flex flex-col items-center gap-1 mt-4 text-sm text-white/60">
                 <button type="button"
                        class="text-sm text-white/70 hover:text-accent underline underline-offset-4"
                        onclick="openPrivacyModal()">
                    Politica de Confidențialitate
                </button>
            </div>


        <!-- TEXT -->
        <a href="https://icode.md/ro/creare-site"
           class="text-[0.75rem] sm:text-xs text-gray-400 hover:text-accent transition">
            Administrare site | iCode.md
        </a>
    </div>
</footer>

<!-- MODAL: Politica de Confidențialitate -->
<div id="privacy-modal"
     class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm
            flex items-center justify-center px-4">

    <div class="bg-[#0B0F19] text-white/90 w-full max-w-4xl max-h-[90vh]
                rounded-2xl shadow-2xl overflow-hidden flex flex-col">

        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-white/10">
            <h2 class="text-xl sm:text-2xl font-bold text-accent">
                Politica de Confidențialitate
            </h2>
            <button type="button"
                    class="text-white/60 hover:text-white text-2xl leading-none"
                    onclick="closePrivacyModal()">
                &times;
            </button>
        </div>

        <!-- CONȚINUT SCROLLABIL -->
        <div class="px-6 py-6 space-y-4 overflow-y-auto text-white/80">

            <!-- INTRO -->
            <h1 class="text-3xl font-bold text-accent mb-2">Politica de Confidențialitate</h1>
            <p><strong>www.integraexpert.md</strong></p>
            <p><strong>Ultima actualizare:</strong> 23 / 11 / 2025</p>

            <p>
                Această Politică de Confidențialitate explică modul în care supervizorul
                Grigore BARLADEAN colectează, utilizează și protejează datele cu caracter personal ale vizitatorilor site-ului www.integraexpert.md.
                Ne angajăm să respectăm drepturile utilizatorilor privind viața privată și protecția datelor, în conformitate cu Regulamentul (UE) 2016/679
                (GDPR) și legislația Republicii Moldova privind protecția datelor cu caracter personal.
            </p>

            <!-- 1. DATE COLECTATE -->
            <h2 class="text-2xl font-semibold text-accent mt-6">1. Datele pe care le colectăm</h2>
            <p>Site-ul poate colecta următoarele categorii de date personale:</p>

            <h3 class="text-xl font-semibold text-white mt-4">1.1. Date furnizate voluntar</h3>
            <ul class="list-disc ml-6 space-y-1">
                <li>Nume și prenume</li>
                <li>Număr de telefon</li>
                <li>Adresă de email</li>
                <li>Mesaj / conținut solicitare</li>
            </ul>
            <p>Aceste date sunt colectate doar când le transmiți voluntar, de exemplu prin formularul de contac</p>

            <h3 class="text-xl font-semibold text-white mt-4">1.2. Date colectate automat</h3>
            <p>Pentru îmbunătățirea experienței utilizatorului, site-ul poate colecta:</p>
            <ul class="list-disc ml-6 space-y-1">
                <li>adresa IP</li>
                <li>tipul dispozitivului</li>
                <li>tipul browserului</li>
                <li>paginile accesate</li>
                <li>durata vizitei</li>
                <li>informații tehnice privind navigarea</li>
            </ul>
            <p>Aceste date sunt colectate prin cookies sau tehnologii similare.</p>

            <h3 class="text-xl font-semibold text-white mt-4">1.3. Cookies</h3>
            <p>Site-ul poate utiliza cookies pentru:</p> 
            <ul class="list-disc ml-6 space-y-1">
                <li>funcționare optimă</li>
                <li>analiză statistică anonimă</li>
                <li>funcții de securitate</li>
                <li>remarketing</li>
            </ul>
            <p>Utilizatorul poate gestiona sau dezactiva cookies din setările browserului.</p>

            <!-- 2 -->
            <h2 class="text-2xl font-semibold text-accent mt-6">2. Scopul prelucrării datelor</h2>
            <p>Datele colectate sunt utilizate pentru următoarele scopuri:</p>
            <ul class="list-disc ml-6 space-y-1">
                <li>răspuns la solicitări și mesaje</li>
                <li>furnizarea serviciilor de supervizare</li>
                <li>îmbunătățirea site-ului</li>
                <li>administrare tehnică</li>
                <li>comunicări profesionale la cerere</li>
            </ul>
            <p>Nu utilizăm datele personale în scopuri comerciale agresive și nu vindem date către terți.</p>

            <!-- 3 -->
            <h2 class="text-2xl font-semibold text-accent mt-6">3. Temeiul legal</h2>
            <p>Datele sunt prelucrate în conformitate cu articolele 6(1) din GDPR. Temeiurile juridice sunt:</P>
            <ul class="list-disc ml-6 space-y-1">
                <li>consimțământ</li>
                <li>executarea contractului</li>
                <li>interes legitim</li>
                <li>obligații legale</li>
            </ul>

            <!-- 4 -->
            <h2 class="text-2xl font-semibold text-accent mt-6">4. Stocarea și protecția datelor</h2>
            <p>Implementăm măsuri tehnice și organizatorice pentru protecția datelor, inclusiv:</p>
            <ul class="list-disc ml-6 space-y-1">
                <li>conexiune securizată SSL</li>
                <li>acces restricționat la date</li>
                <li>măsuri de prevenire a accesului neautorizat</li>
                <li>păstrarea datelor doar cât este necesar</li>
                <li>păstrarea datelor doar pe perioada necesară scopului lor</li>
                <p>Durata de stocare variaza:</p>
                <li>mesaje prin formular: între 6 și 24 de luni</li>
                <li>date pentru servicii contractate: conform legislației și cerințelor fiscale</li>
                <li>cookies: conform duratei setate de browser</li>
            </ul>

            <!-- 5 -->
            <h2 class="text-2xl font-semibold text-accent mt-6">5. Dezvăluirea datelor</h2>
            <p>Datele pot fi dezvăluite către următoarele categorii de terți:</p>
            <ul class="list-disc ml-6 space-y-1">
                <li>servicii IT / hosting</li>
                <li>autorități publice</li>
            </ul>
            <p>Nu transferăm date către terți în scop publicitar.</p>
            <p>Nu transferăm date în afara UE/SEE fără garanții adecvate.</p>

            <!-- 6 -->
            <h2 class="text-2xl font-semibold text-accent mt-6">6. Drepturile utilizatorilor</h2>
            <p>Conform GDPR, ai următoarele drepturi:</p>
            <ul class="list-disc ml-6 space-y-1">
                <li>acces</li>
                <li>rectificare</li>
                <li>ștergere</li>
                <li>restricționare</li>
                <li>portabilitate</li>
                <li>opoziție</li>
                <li>retragerea consimțământului</li>
                <li>plângere la autorități</li>
            </ul>

            <!-- 7 -->
            <h2 class="text-2xl font-semibold text-accent mt-6">7. Minori</h2>
            <p>Nu colectăm date de la persoane sub 16 ani.</p>
            <p>Dacă descoperim astfel de date, le vom șterge imediat.</p>

            <!-- 8 -->
            <h2 class="text-2xl font-semibold text-accent mt-6">8. Linkuri către terți</h2>
            <p>Nu suntem responsabili pentru politicile altor site-uri.</p>
            <p>Site-ul poate conține linkuri către alte pagini.</p>

            <!-- 9 -->
            <h2 class="text-2xl font-semibold text-accent mt-6">9. Modificări</h2>
            <p>Ne rezervăm dreptul de a actualiza această politică.</p>
            <p>Data ultimei actualizări este menționată în partea de sus a paginii.</p>

            <!-- 10 -->
            <h2 class="text-2xl font-semibold text-accent mt-6">10. Contact</h2>
            <ul class="list-disc ml-6 space-y-1">
                <li>Telefon: +373 69 45 99 62</li>
                <li>Email: supervizare@integraexpert.md</li>
                <li>Website: www.integraexpert.md</li>
            </ul>
        </div>

        <!-- FOOTER -->
        <div class="px-6 py-4 border-t border-white/10 flex justify-end">
            <button type="button"
                    class="px-4 py-2 rounded-lg bg-accent/90 hover:bg-accent text-sm font-semibold"
                    onclick="closePrivacyModal()">
                Închide
            </button>
        </div>
    </div>
</div>

<script>
    const privacyModal = document.getElementById('privacy-modal');

    function openPrivacyModal() {
        privacyModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closePrivacyModal() {
        privacyModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Click pe fundal
    privacyModal.addEventListener('click', (e) => {
        if (e.target === privacyModal) closePrivacyModal();
    });

    // ESC pentru închidere
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closePrivacyModal();
    });
</script>
</body>
</html>
