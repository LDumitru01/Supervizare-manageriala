<section class="relative overflow-hidden text-white panel-section pb-24 lg:pb-32">
    <div class="section-inner pt-5 lg:pt-8 min-h-[80vh] flex flex-col">

        <!-- NAV SUS -->
        <header class="w-full flex items-center justify-between gap-6">

            <!-- STÂNGA – logo text (deocamdată gol) -->
            <div class="flex items-center gap-2">
                <!-- Poți pune logo aici -->
            </div>

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
            </nav>

            <!-- CONTACT DESKTOP -->
            <div class="hidden sm:flex items-center gap-4 text-sm">
                <a href="mailto:grigore.barladean@gmail.com"
                   class="text-white/80 hover:text-accent">
                    grigore.barladean@gmail.com
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
            </nav>

            <div class="pt-2 border-t border-white/10 flex flex-col gap-2">
                <a href="mailto:grigore.barladean@gmail.com"
                   class="text-white/80 hover:text-accent">
                    grigore.barladean@gmail.com
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
        <div class="flex-1 grid grid-cols-1 lg:grid-cols-2 gap-10 items-center mt-16">

            <!-- STÂNGA -->
            <div class="space-y-8">

                <div class="inline-flex items-center px-6 py-3 rounded-full 
                            bg-accent/15 border border-accent/30 
                            text-accent font-extrabold text-3xl sm:text-4xl
                            tracking-wide shadow-md">
                    Supervizare Managerială
                </div>

                <h1 class="text-xl sm:text-2xl lg:text-3xl font-semibold leading-snug
                           text-white max-w-xl">
                    Dezvoltă-ți 
                    <span class="text-accent font-bold">excelența profesională</span>
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

            <!-- DREAPTA -->
            <div class="w-full h-[300px] lg:h-[360px] rounded-3xl bg-white/5 border border-white/10
                        backdrop-blur-md flex items-center justify-center
                        text-gray-400 text-sm italic">
                [Imagine reprezentativă sau ilustrație aici]
            </div>

        </div>
    </div>
</section>
