<div>
    @auth
    <a wire:click="toggle" class="cursor-pointer flex items-center gap-1">
        @if ($heartable->isHearted())
        <span class="text-red-500 text-lg">&hearts;</span>
        @else
        <span class="text-gray-500 text-lg hover:text-red-400">&hearts;</span>
        @endif
        <span class="text-xs text-gray-400">{{ $heartable->hearts()->count() }}</span>
    </a>
    @else
    <span class="flex items-center gap-1 cursor-not-allowed">
        <span class="text-gray-600 text-lg">&hearts;</span>
        <span class="text-xs text-gray-500">{{ $heartable->hearts()->count() }}</span>
    </span>
    @endauth
</div>
