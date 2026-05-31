@props(['dark' => false])
<nav class="flex items-center justify-between h-16">
    <div>
        <a href="{{ route('home') }}" class="{{ $dark ? 'text-gray-900' : 'text-white' }}">
            <x-forum.logo />
        </a>
    </div>
    <div class="flex gap-4">
        <a href="{{ route('questions.index') }}" class="text-sm font-semibold {{ $dark ? 'text-gray-700 hover:text-gray-900' : 'text-gray-100 hover:text-white' }}">Foro</a>
    </div>
    <div class="flex items-center gap-4">
        @auth
            <span class="text-sm font-semibold {{ $dark ? 'text-gray-700' : 'text-gray-300' }}">Welcome, {{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="rounded-full {{ $dark ? 'bg-gray-900 hover:bg-gray-800 text-white' : 'bg-neutral-700 hover:bg-neutral-600 text-white' }} px-3 py-1 text-sm font-medium">Log out</button>
            </form>
        @else
		<a href="{{ route('login') }}" class="text-sm font-semibold {{ $dark ? 'text-gray-900 hover:text-gray-700 border border-gray-300 px-3 py-1 rounded-full' : 'text-gray-100 hover:text-white' }}">Log in &rarr;</a>
        @endauth
    </div>
</nav>
