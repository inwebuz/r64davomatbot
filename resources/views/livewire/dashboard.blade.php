<section class="w-full">
    <div>
        <div class="flex flex-col lg:flex-row gap-4 mb-4">
            <div>
                <flux:select wire:model.live="filters.user_id" :label="__('Select employee')">
                    <flux:select.option value="">{{ __('All') }}</flux:select.option>
                    @foreach ($allEmployees as $employee)
                        <flux:select.option value="{{ $employee->id }}" wire:key="{{ $employee->id }}">{{ $employee->name }}</flux:select.option>
                    @endforeach
                </flux:select>
            </div>
            <div>
                <flux:input class="daterange-picker" data-target="#stats-date-range-picker" :label="__('Select date range')" />
                <input type="hidden" wire:model.live="filters.date_range" id="stats-date-range-picker" class="border">
            </div>
        </div>
    </div>
    @if ($stats->isNotEmpty())
        <x-table class="mb-4" wire:loading.remove>
            <x-slot:head>
                <x-table.heading class="cursor-pointer">{{ __('Employee') }}</x-table.heading>
                <x-table.heading class="cursor-pointer">{{ __('Total hours') }}</x-table.heading>
                <x-table.heading class="cursor-pointer">{{ __('Total work time') }}</x-table.heading>
            </x-slot:head>
            @foreach ($stats as $stat)
                <x-table.row :key="$stat['employee']->id">
                    <x-table.cell> {{ $stat['employee']->name }} </x-table.cell>
                    <x-table.cell class="whitespace-nowrap">{{ $stat['totalHours'] }} {{ __('hours') }}</x-table.cell>
                    <x-table.cell class="whitespace-nowrap">{{ $stat['totalDays'] }} {{ __('work days') }}</x-table.cell>
                </x-table.row>
            @endforeach
        </x-table>
    @endif
    <div wire:loading>
        <flux:icon.loading />
    </div>
</section>
