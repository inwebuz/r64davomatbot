<table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-zinc-200 dark:divide-zinc-700']) }}>
    <thead class="bg-zinc-100 dark:bg-zinc-700">
        {{ $head }}
    </thead>
    <tbody class="bg-white dark:bg-zinc-800 divide-y divide-zinc-200 dark:divide-zinc-700">
        {{ $slot }}
    </tbody>
</table>
