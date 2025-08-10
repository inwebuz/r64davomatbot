<section class="w-full">
    <div>
        <flux:heading size="xl" level="1" class="mb-5">{{ __('Work times') }}</flux:heading>

        <div class="mb-4">
            <flux:select wire:model.live="filters.user_id" :label="__('Select employee')">
                <flux:select.option value="">{{ __('All') }}</flux:select.option>
                @foreach ($employees as $employee)
                    <flux:select.option value="{{ $employee->id }}" wire:key="{{ $employee->id }}">{{ $employee->name }}</flux:select.option>
                @endforeach
            </flux:select>
        </div>

        <div wire:loading.remove>
            <x-table class="mb-4">
                <x-slot:head>
                    <x-table.heading class="w-1"></x-table.heading>
                    <x-table.heading>{{ __('Employee') }}</x-table.heading>
                    <x-table.heading>{{ __('Start time') }}</x-table.heading>
                    <x-table.heading>{{ __('End time') }}</x-table.heading>
                    <x-table.heading>{{ __('Duration') }}</x-table.heading>
                </x-slot:head>

                @foreach ($this->workTimes as $workTime)
                    <x-table.row :key="$workTime->id">
                        <x-table.cell>
                            <flux:button.group>
                                <flux:button variant="ghost" size="sm" icon="pencil" href="{{ route('work-times.edit', $workTime) }}" wire:navigate />
                                <flux:button variant="ghost" size="sm" icon="trash" wire:click="deleteWorkTime({{ $workTime->id }})" wire:confirm="{{ __('Are you sure?') }}" />
                            </flux:button.group>
                        </x-table.cell>
                        <x-table.cell> {{ $workTime->user?->name }} </x-table.cell>
                        <x-table.cell class="whitespace-nowrap">{{ Helper::formatDatetime($workTime->start_time) }}</x-table.cell>
                        <x-table.cell class="whitespace-nowrap">{{ $workTime->end_time ? Helper::formatDatetime($workTime->end_time) : '-' }}</x-table.cell>
                        <x-table.cell class="whitespace-nowrap">{{ Helper::formatHoursMinutes($workTime->duration) }}</x-table.cell>
                    </x-table.row>
                @endforeach
            </x-table>

            <div class="mt-4">
                {{ $this->workTimes->links() }}
            </div>
        </div>

        <div wire:loading>
            <flux:icon.loading />
        </div>

        <x-alert-toast event="work-time-deleted" :message="__('Work time deleted successfully')" type="success" />

    </div>
</section>
