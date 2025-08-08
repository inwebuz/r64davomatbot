<x-layouts.auth.simple :title="config('app.name')">
    <flux:heading level="1" size="xl" class="text-center mb-5">
        {{ config('app.name') }}
    </flux:heading>
    @if (Route::has('login'))
        <div class="flex items-center justify-center gap-4">
            @auth
                <flux:button href="{{ url('/dashboard') }}" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:button>
            @else
                <flux:button href="{{ route('login') }}" wire:navigate>
                    {{ __('Log in') }}
                </flux:button>
            @endauth
        </div>
    @endif
</x-layouts.auth.simple>
