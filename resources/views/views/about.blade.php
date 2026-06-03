<x-forum.layouts.app>
    <div class="my-10 max-w-2xl mx-auto space-y-10">

        {{-- Propósito --}}
        <section>
            <h1 class="text-2xl font-bold text-white mb-3">Acerca de CodeLab</h1>
            <p class="text-gray-400 leading-relaxed">
                CodeLab es una plataforma comunitaria diseñada para estudiantes de programación.
                Su propósito es centralizar el conocimiento generado en el laboratorio: compartir soluciones
                a errores comunes, documentar prácticas y fomentar la colaboración entre compañeros.
                Cada hilo es un registro de aprendizaje colectivo.
            </p>
        </section>

        {{-- Stack --}}
        <section>
            <h2 class="text-lg font-semibold text-white mb-4 border-b border-neutral-700 pb-2">Arquitectura Tecnológica</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach ([
                    ['Backend',         'Laravel 12 — MVC, Eloquent ORM, Livewire 3',     'bg-red-900/30 text-red-300'],
                    ['Frontend',        'Blade Templates · Alpine.js · Tailwind CSS v4',  'bg-sky-900/30 text-sky-300'],
                    ['Base de Datos',   'PostgreSQL (Render Cloud)',                       'bg-emerald-900/30 text-emerald-300'],
                    ['Infraestructura', 'Render · UptimeRobot · Cloudflare',              'bg-yellow-900/30 text-yellow-300'],
                ] as [$label, $desc, $color])
                <div class="bg-neutral-800 border border-neutral-700 rounded-lg p-4">
                    <span class="inline-block text-xs font-semibold px-2 py-0.5 rounded-full {{ $color }} mb-2">{{ $label }}</span>
                    <p class="text-sm text-gray-400">{{ $desc }}</p>
                </div>
                @endforeach
            </div>
        </section>

        {{-- Desarrollador --}}
        <section>
            <h2 class="text-lg font-semibold text-white mb-4 border-b border-neutral-700 pb-2">El Desarrollador</h2>
            <div class="bg-neutral-800 border border-neutral-700 rounded-lg p-5 flex items-center gap-5">
                <div class="size-14 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold text-xl shrink-0">
                    A
                </div>
                <div>
                    <p class="text-white font-semibold">Alexis CE</p>
                    <p class="text-sm text-gray-400 mb-3">Full-Stack Student Developer</p>
                    <div class="flex gap-3">
                        <a href="https://github.com/Alexis-CE" target="_blank"
                           class="text-xs text-indigo-400 hover:text-indigo-300 border border-indigo-800 hover:border-indigo-600 px-3 py-1 rounded-full transition-colors">
                            GitHub →
                        </a>
                        <a href="#" {{-- reemplaza con tu portafolio --}}
                           class="text-xs text-gray-400 hover:text-white border border-neutral-600 hover:border-neutral-400 px-3 py-1 rounded-full transition-colors">
                            Portafolio →
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </div>
</x-forum.layouts.app>
