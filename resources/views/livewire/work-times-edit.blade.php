<section class="w-full">
    <div>
        <flux:heading size="xl" level="1" class="mb-5">{{ __('Edit work time') }}</flux:heading>

        <div>
            <form wire:submit.prevent="update">
                <div class="grid gap-4 md:grid-cols-2 mb-4">
                    <flux:input wire:model="startTime" class:input="datetime-picker" label="{{ __('Start time') }}" required />
                    <flux:input wire:model="endTime" class:input="datetime-picker" label="{{ __('End time') }}" required />
                </div>

                <flux:button type="submit">{{ __('Update') }}</flux:button>
            </form>
        </div>
    </div>

    <x-alert-toast event="work-time-updated" :message="__('Work time updated successfully')" type="success" />

</section>
