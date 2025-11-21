<section class="relative overflow-hidden text-white panel-section pb-24 lg:pb-32 px-4 sm:px-6 lg:px-8">

  <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px]
                    bg-accent/20 blur-[150px] rounded-full"></div>

        <div class="absolute bottom-[-20%] right-[-5%] w-[500px] h-[500px]
                    bg-blue-500/5 blur-[180px] rounded-full"></div>

        <!-- <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/20"></div> -->
    </div>
    <div class="section-inner pt-5 lg:pt-8 min-h-[80vh] flex flex-col">

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
            </nav>

            <!-- CONTACT DESKTOP (email + Facebook + telefon) -->
            <div class="hidden sm:flex items-center gap-4 text-sm">
                <a href="mailto:grigore.barladean@gmail.com"
                   class="text-white/80 hover:text-accent">
                    grigore.barladean@gmail.com
                </a>

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
                                rounded rounded-tl-none rounded-bl-none">

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
    </div>
</section>
