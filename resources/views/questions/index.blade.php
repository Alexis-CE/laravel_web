<x-forum.layouts.app>
    <div class="my-8">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold text-white">Discusiones</h1>
            @auth
            <a href="{{ route('questions.create') }}"
               class="bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold px-4 py-2 rounded-md transition-colors">
                + Nueva Discusión
            </a>
            @endauth
        </div>

        {{-- Layout 2 columnas --}}
        <div class="flex gap-6">

            {{-- Sidebar categorías --}}
            <aside class="w-48 shrink-0 hidden md:block">
                <div class="bg-neutral-800 rounded-lg p-4 sticky top-4">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Categorías</p>
                    <ul class="space-y-1">
                        <li><a href="{{ route('questions.index') }}" class="block text-sm text-gray-300 hover:text-white px-2 py-1.5 rounded hover:bg-neutral-700 transition-colors {{ !request('categoria') ? 'bg-neutral-700 text-white' : '' }}">Todas</a></li>
                        @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('questions.index', ['categoria' => $cat->name]) }}"
                               class="block text-sm text-gray-300 hover:text-white px-2 py-1.5 rounded hover:bg-neutral-700 transition-colors {{ request('categoria') == $cat->name ? 'bg-neutral-700 text-white' : '' }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            {{-- Feed de preguntas --}}
            <div class="flex-1 min-w-0">
                @forelse ($questions as $question)
                <div class="bg-neutral-800 rounded-lg p-4 mb-3 hover:bg-neutral-750 border border-neutral-700 hover:border-neutral-600 transition-all">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            {{-- Tag categoría --}}
                            <span class="inline-block text-xs font-medium px-2 py-0.5 rounded-full bg-indigo-900/60 text-indigo-300 mb-2">
                                {{ $question->category->name }}
                            </span>

                            <h2 class="text-base font-semibold text-white leading-snug">
                                <a href="{{ route('questions.show', $question) }}" class="hover:text-indigo-400 transition-colors">
                                    {{ $question->title }}
                                </a>
                            </h2>

                            <p class="text-xs text-gray-500 mt-1.5">
                                <span class="text-gray-400 font-medium">{{ $question->user->name }}</span>
                                · {{ $question->created_at->diffForHumans() }}
                            </p>
                        </div>

                        {{-- Contadores --}}
                        <div class="shrink-0 flex flex-col items-center gap-2 text-center">
                            <div class="text-xs text-gray-500">
                                <span class="block text-lg font-bold text-gray-300">{{ $question->answers_count ?? $question->answers()->count() }}</span>
                                resp.
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-16 text-gray-500">
                    <p class="text-lg mb-2">Sin discusiones aún</p>
                    @auth
                    <a href="{{ route('questions.create') }}" class="text-indigo-400 hover:underline text-sm">¡Sé el primero en preguntar!</a>
                    @endauth
                </div>
                @endforelse

                <div class="mt-4">{{ $questions->links() }}</div>
            </div>
        </div>
    </div>
</x-forum.layouts.app>
