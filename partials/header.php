
<html>
<body>
<section class="relative overflow-hidden text-white panel-section pb-24 lg:pb-32 px-4 sm:px-6 lg:px-8">

  <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px]
                    bg-accent/20 blur-[150px] rounded-full"></div>

        <div class="absolute bottom-[-20%] right-[-5%] w-[500px] h-[500px]
                    bg-blue-500/5 blur-[180px] rounded-full"></div>

        <!-- <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/20"></div> -->
    </div>
    <div class="section-inner pt-5 lg:pt-8 min-h-[80vh] flex flex-col">

    <?php
    $currentPage = basename($_SERVER['PHP_SELF']);
    ?>
        <!-- NAV SUS -->
        <header class="w-full flex items-center justify-between gap-6">

            <!-- NAV DESKTOP -->
            <nav
                class="hidden md:flex items-center gap-10 text-sm
                       px-6 py-2.5 rounded-2xl
                       bg-white/5 border border-white/10 backdrop-blur-xl
                       shadow-lg hover:shadow-[0_0_40px_rgba(34,197,172,0.15)]
                       transition">

                <a href="#de-ce-acum" class="text-white/80 hover:text-accent transition">
                    De ce acum?
                </a>
                <a href="#ce-este" class="text-white/80 hover:text-accent transition">
                    Ce este?
                </a>
                <a href="#pentru-cine" class="text-white/80 hover:text-accent transition">
                    Pentru manageri?
                </a>
                <a href="#beneficii" class="text-white/80 hover:text-accent transition">
                    Ce primești?
                </a>
                <a href="#testimoniale" class="text-white/80 hover:text-accent transition">
                    Testimoniale
                </a>
                <a href="#blog" class="text-white/80 hover:text-accent transition">
                    Blog
                </a>
            </nav>

            <div class="flex sm:flex items-center gap-4 text-xs sm:text-sm">
                <button type="button"
                        class="text-xs sm:text-sm text-white/70 hover:text-accent underline underline-offset-4"
                        onclick="openEthicsModal()">
                    Cod de Etică Profesională
                </button>
            </div>

            <!-- CONTACT DESKTOP (email + Facebook + telefon) -->
            <div class="hidden sm:flex items-center gap-4 text-sm">
               

                <!-- LINK FACEBOOK -->
                <a href="https://www.facebook.com/profile.php?id=61569330804221"
                    target="_blank" rel="noopener"
                    aria-label="Profil Facebook"
                    class="w-9 h-9 flex items-center justify-center rounded-full
                            border border-accent/60 text-accent
                            hover:bg-accent hover:text-primary
                            transition">
                    <!-- Icon Facebook (SVG) -->
                    <svg viewBox="0 0 24 24"
                        class="w-4 h-4" fill="currentColor">
                        <path d="M13.5 22v-7h2.5a1 1 0 0 0 .99-.86l.38-3a1 1 0 0 0-.99-1.14H13.5V7.5A1.5 1.5 0 0 1 15 6h1.5a1 1 0 0 0 1-1V3.5a1 1 0 0 0-1-1H15a4.5 4.5 0 0 0-4.5 4.5v2.5H8.5a1 1 0 0 0-1 .86l-.38 3A1 1 0 0 0 8.5 15h2V22Z"/>
                    </svg>
                </a>

                <a href="tel:069459962"
                   class="px-4 py-2 rounded-full border border-accent text-accent
                          hover:bg-accent hover:text-primary transition
                          text-xs sm:text-sm font-semibold">
                    069 459 962
                </a>
            </div>

            <!-- BUTON MENIU MOBIL -->
            <button id="mobile-menu-toggle"
                    class="md:hidden inline-flex items-center justify-center px-3 py-2
                           rounded-full border border-accent/60 text-accent text-sm">
                <span class="mr-1 text-xs">Meniu</span>
                <span id="mobile-menu-icon"
                      class="text-lg leading-none transition-transform duration-200">
                    ▼
                </span>
            </button>
        </header>

        <!-- MENIU MOBIL -->
        <div id="mobile-menu"
             class="md:hidden mt-4 space-y-4 text-sm text-white/90 hidden">
            <nav class="flex flex-col gap-2">
                <a href="#de-ce-acum" class="hover:text-accent">De ce acum?</a>
                <a href="#ce-este" class="hover:text-accent">Ce este?</a>
                <a href="#pentru-cine" class="hover:text-accent">Pentru manageri</a>
                <a href="#beneficii" class="hover:text-accent">Ce primești?</a>
                <a href="#testimoniale" class="hover:text-accent">Testimoniale</a>
                <a href="#blog" class="hover:text-accent">Blog</a>
            </nav>

            <div class="pt-2 border-t border-white/10 flex flex-col gap-2">
                <a href="mailto:grigore.barladean@gmail.com"
                   class="text-white/80 hover:text-accent">
                    grigore.barladean@gmail.com
                </a>
                
                <a href="https://www.facebook.com/profile.php?id=61569330804221"
                   target="_blank" rel="noopener"
                   class="text-white/80 hover:text-accent">
                    Facebook
                </a>
                <a href="tel:069459962"
                   class="inline-flex items-center justify-center px-4 py-2
                          rounded-full border border-accent text-accent
                          hover:bg-accent hover:text-primary transition
                          text-sm font-semibold w-full">
                    069 459 962
                </a>
            </div>
        </div>

        
        <!-- HERO: conținut principal -->
        <?php if ($currentPage == 'index.php'): ?>
        <div class="flex-1 grid grid-cols-1 lg:grid-cols-2 gap-10 items-center mt-16">

            <!-- STÂNGA -->
            <div class="space-y-8">

                <div class="inline-flex justify-center items-center
                    px-6 py-3 rounded-full 
                    bg-accent/15 border border-accent/30 
                    text-accent font-extrabold text-3xl sm:text-4xl
                    tracking-wide shadow-md text-center mx-auto">
                    Supervizare Managerială
                </div>

                <h1 class="text-xl sm:text-2xl lg:text-3xl font-semibold leading-snug
                           text-white max-w-xl">
                    Dezvoltă-ți
                    <span class="text-accent font-bold">
                        excelența profesională
                    </span>
                    prin supervizare — un proces
                    reflexiv care clarifică direcția și întărește leadershipul.
                </h1>

                <p class="text-base sm:text-lg text-white/80 max-w-md leading-relaxed">
                    Creează spațiu pentru claritate, creștere și decizii asumate.
                </p>

                <div class="flex flex-wrap gap-4 pt-2">
                    <a href="#formular"
                       class="px-5 py-2.5 rounded-full bg-accent text-primary text-sm font-semibold
                              shadow hover:bg-teal-400 transition">
                        Programează o sesiune gratuită
                    </a>

                    <a href="#de-ce-acum"
                       class="px-5 py-2.5 rounded-full border border-white/20 text-white text-sm
                              font-medium backdrop-blur-md hover:bg-white/10 transition">
                        De ce supervizare?
                    </a>
                </div>
            </div>

            <!-- DREAPTA – CARD IMAGINE -->
           <div class="relative w-full max-w-[420px] mx-auto group">

                <!-- GLOW DIN SPATE LA HOVER -->
                <div class="absolute -inset-2 rounded-[32px]
                            bg-gradient-to-tr from-accent/40 via-transparent to-accent/40
                            opacity-0 blur-xl transition
                            group-hover:opacity-100"></div>

                <!-- CARD IMAGINE -->
                <div class="relative rounded-[32px] overflow-hidden
                            backdrop-blur-xl
                            shadow-[0_25px_80px_rgba(0,0,0,0.85)]
                            transform transition
                            group-hover:-translate-y-1 group-hover:scale-[1.02] group-hover:rotate-1">

                    <div class="relative w-full max-w-[320px] mx-auto
                                bg-white/5 border border-white/10 backdrop-blur-xl overflow-hidden
                                rounded-tr-3xl rounded rounded-tl-none rounded-bl-none">

                        <img src="./Images/img1.jpg"
                            alt="Portret"
                            class="w-full h-auto object-cover rounded-none">
                    </div>

                    
                    <!-- BADGE MIC PE IMAGINE -->
                    <div class="absolute bottom-4 right-4
                                px-3 py-1.5 rounded-full bg-black/70
                                text-[11px] text-white/80 flex items-center gap-2">
                        <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Disponibil pentru sesiuni online
                    </div>
                </div>
            </div>

        </div>
        <?php endif; ?>
    </div>
</section>

<!-- MODAL: Cod de Etică Profesională -->
<div id="ethics-modal"
     class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm
            flex items-center justify-center px-4">

    <!-- Panelul modalului -->
    <div class="bg-[#0B0F19] text-white/90 w-full max-w-4xl max-h-[90vh]
                rounded-2xl shadow-2xl overflow-hidden flex flex-col">

        <!-- HEADER MODAL -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-white/10">
            <h2 class="text-xl sm:text-2xl font-bold text-accent">
                Cod de Etică Profesională
            </h2>
            <button type="button"
                    class="text-white/60 hover:text-white text-2xl leading-none"
                    onclick="closeEthicsModal()">
                &times;
            </button>
        </div>

        <!-- CONȚINUT SCROLLABIL -->
        <div class="px-6 py-6 space-y-4 overflow-y-auto">
            <p class="text-white/70">
                <strong>Cod de Etică Profesională al supervizorului Grigore BARLADEAN</strong>
            </p>

            <h2 class="text-2xl font-semibold mt-4 mb-2 text-accent">1. Preambul</h2>
            <p class="text-white/80">
                Eu, <span class="font-bold italic">Grigore BARLADEAN</span>, în calitate de <span class="font-bold italic">supervizor certificat</span> de CIS, denumit în
                continuare „supervizor”, declar că adopt acest Cod de Etică pentru a asigura calitatea, integritatea
                și siguranța procesului de supervizare profesională și managerială.
            </p>
            <p>Scopul fundamental al activității mele <span class="font-bolt italic">este protecția și beneficiul clientului</span>, prin abordarea
                sistemică a reflecției profesionale de către supervizat/supervizați.</P>

            <h2 class="text-2xl font-semibold mt-6 mb-2 text-accent">2. Principii fundamentale</h2>

            <h3 class="text-xl font-semibold mt-4 text-white">2.1. Beneficiul și protecția clientului</h3>
            <ul class="list-disc ml-6 mt-2 text-white/80 space-y-1">
                <li>Toate acțiunile urmăresc interesul clientului.</li>
                <li>Persoana supervizată este informată că supervizarea are ca scop dezvoltarea personală și
                    creșterea profesională într-un spațiu sigur; totodată, procesul urmărește îmbunătățirea
                    activă a calității serviciilor pe care supervizatul/supervizații le oferă propriilor clienți.</li>
                <li>Respect drepturile, demnitatea, autonomia și siguranța clientului.</li>
            </ul>

            <h3 class="text-xl font-semibold mt-4 text-white">2.2. Confidențialitate</h3>
            <ul class="list-disc ml-6 mt-2 text-white/80 space-y-1">
                <li>Informațiile obținute în cadrul supervizării sunt strict confidențiale.</li>
                <li>Datele obținute de către supervizor în procesul de supervizare pot fi folosite numai pe
                    baza acordului scris al persoanei vizate, în scopul stabilit în acord.</li>
                <li>Confidențialitatea continuă și după încheierea contractului pentru un termen nelimitat.</li>
            </ul>

            <h3 class="text-xl font-semibold mt-4 text-white">2.3. Integritate profesională</h3>
            <ul class="list-disc ml-6 mt-2 text-white/80 space-y-1">
                <li>Prezint corect și transparent calificările mele profesionale.</li>
                <li>Accept numai contracte pentru care am formarea, experiența și competențele necesare.</li>
                <li>Evit în mod activ orice situație de conflict de interese.</li>
            </ul>

            <h2 class="text-2xl font-semibold mt-6 mb-2 text-accent">3. Relația cu persoana supervizată</h2>

            <h3 class="text-xl font-semibold mt-4 text-white">3.1. Contractul de supervizare</h3>
            <ul class="list-disc ml-6 mt-2 text-white/80 space-y-1">
                <li>Relația profesională începe cu un contract clar privind scopul, durata, limitele,
                    responsabilitățile și onorariile.</li>
                <li>Modificările contractului se fac numai cu acordul ambelor părți.</li>
                <li>Încetarea contractului nu va afecta interesul profesional al persoanei supervizate.</li>
            </ul>

            <h3 class="text-xl font-semibold mt-4 text-white">3.2. Respect și non-abuz</h3>
            <ul class="list-disc ml-6 mt-2 text-white/80 space-y-1">
                <li>Nu folosesc niciodată relația de supervizare pentru obținerea unui avantaj personal</li>
                <li>Orice formă de abuz, manipulare sau intimidare este interzisă.</li>
            </ul>

            <h3 class="text-xl font-semibold mt-4 text-white">3.3. Limite și incompatibilități</h3>
            <ul class="list-disc ml-6 mt-2 text-white/80 space-y-1">
                <li>Nu contractez supervizare persoanelor care au fost anterior în formare experiențială cu
                    mine. Totodată, consider etic procesul intervizării profesionale/manageriale bazat pe
                    suport pro bono.</li>
                <li>Evit cumularea de roluri (formator – supervizor – consultant) sau, unde este necesar,
                    delimitez clar rolurile în timp și spațiu și comunic schimbările de rol.</li>
            </ul>

            <h2 class="text-2xl font-semibold mt-6 mb-2 text-accent">4. Competență și dezvoltare</h2>

            <h3 class="text-xl font-semibold mt-4 text-white">4.1. Formare continuă</h3>
            <ul class="list-disc ml-6 mt-2 text-white/80 space-y-1">
                <li>Mă angajez la formare profesională continuă, actualizare și supervizare a propriei activități.</li>
                <li>Mențin standarde profesionale ridicate de cunoaștere și intervenție.</li>
            </ul>

            <h3 class="text-xl font-semibold mt-4 text-white">4.2. Responsabilitate profesională</h3>
            <ul class="list-disc ml-6 mt-2 text-white/80 space-y-1">
                <li>Ghidez persoana supervizată în înțelegerea obligațiilor etice, juridice și profesionale ale
                    practicii sale.</li>
                <li>Nu înlocuiesc terapia sau intervenția psihologică în situațiile în care acestea sunt necesare;
                    le recomand clar.</li>
            </ul>

            <h2 class="text-2xl font-semibold mt-6 mb-2 text-accent">5. Practică profesională și limite etice</h2>
            <h3 class="text-xl font-semibold mt-4 text-white">5.1. Documentare și monitorizare</h3>
            <ol class="list-decimal ml-6 mt-2 text-white/80 space-y-1">
                <li>Procesele de supervizare sunt documentate într-un mod adecvat și sigur.</li>
                <li>Monitorizarea poate include notițe, rapoarte sau înregistrări, realizate doar cu
                    consimțământul explicit al persoanei implicate</li>
            </ol>

            <h3 class="text-xl font-semibold mt-4 text-white">5.2. Documentare și monitorizare</h3>
            <ol class="list-decimal ml-6 mt-2 text-white/80 space-y-1">
                <p>În situații etice complexe, ordinea priorităților este:</p>
                <li>Legislația și standardele etice</li>
                <li>Siguranța clientului</li>
                <li>Protecția supervizatului</li>
                <li>Responsabilitatea supervizorului</li>
                <li>Cerințele instituționale</li>
            </ol>

            <h2 class="text-2xl font-semibold mt-6 mb-2 text-accent">6. Relațiile profesionale și responsabilitățile sociale</h2>
            <h3 class="text-xl font-semibold mt-4 text-white">6.1. Comportament profesional</h3>
            <ol class="list-decimal ml-6 mt-2 text-white/80 space-y-1">
                <li>Evit comentariile denigratoare la adresa colegilor în spațiul public.</li>
                <li>Critica profesională este exprimată doar în cadrele adecvate.</li>
            </ol>

            <h3 class="text-xl font-semibold mt-4 text-white">6.2. Raportarea neregulilor etice</h3>
            <ol class="list-decimal ml-6 mt-2 text-white/80 space-y-1">
                <li>În cazuri de abateri grave ale unui coleg, am responsabilitatea profesională de a semnala
                    acest lucru în forurile adecvate.</li>
            </ol>

            <h2 class="text-2xl font-semibold mt-6 mb-2 text-accent">Confidențialitate și protecția datelor</h2>
            <ol class="list-decimal ml-6 mt-2 text-white/80 space-y-1">
                <li>Respect legislația privind protecția datelor cu caracter personal.</li>
                <li>Protejez sau anonimizez datele sensibile.</li>
                <li>Informațiile sunt folosite strict în limitele contractului.</li>
            </ol>
            
            <h2 class="text-2xl font-semibold mt-6 mb-2 text-accent">Secțiunea finală</h2>
            <p class="text-white/80 mb-2">
                Prin acest Cod de Etică, îmi asum în mod responsabil menținerea celor mai înalte standarde
                profesionale și etice în activitatea mea de supervizor.
            </p>

           <div class="px-6 py-6  flex justify-end">
                <img src="Images/semnatura.jpg"
                    alt="Semnătură digitală"
                    class="w-32 sm:w-40 md:w-48 rounded-lg shadow-lg border border-white/10">
            </div>
        </div>

        <!-- FOOTER MODAL (buton închidere) -->
        <div class="px-6 py-4 border-t border-white/10 flex justify-end">
            <button type="button"
                    class="px-4 py-2 rounded-lg bg-accent/90 hover:bg-accent text-sm font-semibold"
                    onclick="closeEthicsModal()">
                Închide
            </button>
        </div>
    </div>

    
</div>
<script>
    const ethicsModal = document.getElementById('ethics-modal');

    function openEthicsModal() {
        ethicsModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeEthicsModal() {
        ethicsModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    ethicsModal.addEventListener('click', (e) => {
        if (e.target === ethicsModal) {
            closeEthicsModal();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeEthicsModal();
        }
    });
</script>

</body>
</html>
