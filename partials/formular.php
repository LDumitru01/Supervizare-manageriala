<!-- SECȚIUNE FORMULAR -->
<section id="formular" class="panel-section py-20 px-4 sm:px-6 lg:px-8">
    <div class="section-inner">

        <!-- TITLU + SUBTITLU -->
        <h2 class="text-center text-accent font-extrabold tracking-tight 
           text-4xl sm:text-5xl lg:text-6xl drop-shadow-[0_4px_20px_rgba(34,197,172,0.25)] uppercase">
            Programează o sesiune exploratorie gratuită
        </h2>
        <p class="section-inner mt-4 text-center text-sm sm:text-base text-white/80 max-w-2xl mx-auto">
            Completează formularul de mai jos, iar eu voi reveni cu un răspuns pentru a stabili împreună
            ziua și ora potrivită pentru tine.
        </p>

        <!-- CARD FORMULAR -->
        <div class="mt-10 rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl shadow-2xl p-6 sm:p-8 lg:p-10">
            <form action="#" method="POST" class="space-y-6">

                <!-- NUME + PRENUME -->
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="space-y-1.5">
                        <label for="firstName" class="text-xs font-semibold tracking-[0.18em] uppercase text-white/60">
                            Nume
                        </label>
                        <input
                            id="firstName"
                            name="firstName"
                            type="text"
                            placeholder="Numele tău"
                            class="w-full rounded-xl bg-black/30 border border-white/15 px-4 py-3 text-sm sm:text-base text-white placeholder-white/35
                                   focus:outline-none focus:ring-2 focus:ring-accent/70 focus:border-accent/70 transition"
                            required
                        /> 
                    </div>

                    <div class="space-y-1.5">
                        <label for="lastName" class="text-xs font-semibold tracking-[0.18em] uppercase text-white/60">
                            Prenume
                        </label>
                        <input
                            id="lastName"
                            name="lastName"
                            type="text"
                            placeholder="Prenumele tău"
                            class="w-full rounded-xl bg-black/30 border border-white/15 px-4 py-3 text-sm sm:text-base text-white placeholder-white/35
                                   focus:outline-none focus:ring-2 focus:ring-accent/70 focus:border-accent/70 transition"
                            required
                        />
                    </div>
                </div>

                <!-- EMAIL + TELEFON -->
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="space-y-1.5">
                        <label for="email" class="text-xs font-semibold tracking-[0.18em] uppercase text-white/60">
                            Email
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            placeholder="exemplu@domeniu.com"
                            class="w-full rounded-xl bg-black/30 border border-white/15 px-4 py-3 text-sm sm:text-base text-white placeholder-white/35
                                   focus:outline-none focus:ring-2 focus:ring-accent/70 focus:border-accent/70 transition"
                            required
                        />
                    </div>

                    <div class="space-y-1.5">
                        <label for="phone" class="text-xs font-semibold tracking-[0.18em] uppercase text-white/60">
                            Telefon
                        </label>
                        <input
                            id="phone"
                            name="phone"
                            type="tel"
                            placeholder="06xx xxx xxx"
                            class="w-full rounded-xl bg-black/30 border border-white/15 px-4 py-3 text-sm sm:text-base text-white placeholder-white/35
                                   focus:outline-none focus:ring-2 focus:ring-accent/70 focus:border-accent/70 transition"
                        />
                    </div>
                </div>

                <!-- MESAJ -->
                <div class="space-y-1.5">
                    <label for="message" class="text-xs font-semibold tracking-[0.18em] uppercase text-white/60">
                        Mesaj (opțional)
                    </label>
                    <textarea
                        id="message"
                        name="message"
                        rows="4"
                        placeholder="Spune-mi pe scurt contextul tău profesional sau întrebările pe care le ai."
                        class="w-full rounded-xl bg-black/30 border border-white/15 px-4 py-3 text-sm sm:text-base text-white placeholder-white/35
                               focus:outline-none focus:ring-2 focus:ring-accent/70 focus:border-accent/70 transition resize-none"
                    ></textarea>
                </div>

                <!-- BUTON + TEXT MIC -->
                <div class="pt-2 space-y-3">
                    <button
                        type="submit"
                        class="w-full sm:w-auto px-10 py-3.5 rounded-full bg-accent text-primary font-semibold text-sm sm:text-base
                               shadow-lg shadow-accent/30 hover:bg-teal-400 transition flex items-center justify-center gap-2 mx-auto">
                        Trimite solicitarea
                    </button>

                    <p class="text-[11px] sm:text-xs text-center text-white/50 max-w-lg mx-auto">
                        Prin trimiterea formularului îți exprimi acordul pentru a fi contactat(ă) în scopul programării unei sesiuni
                        de supervizare. Datele tale vor fi tratate cu confidențialitate.
                    </p>
                </div>

            </form>
        </div>
    </div>
</section>
