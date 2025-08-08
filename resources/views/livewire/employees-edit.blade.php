<section class="w-full">
    <div>
        <flux:heading size="xl" level="1" class="mb-5">{{ __('Edit employee') }}</flux:heading>

        <div>
            <form wire:submit.prevent="update">
                <div class="grid gap-4 md:grid-cols-2 mb-4">
                    <flux:input wire:model="name" label="{{ __('Name') }}" required />
                    <flux:input wire:model="phone" label="{{ __('Phone') }}" required />
                </div>

                <flux:button type="submit">{{ __('Update') }}</flux:button>
            </form>
        </div>
    </div>

    <x-alert-toast event="user-updated" :message="__('Employee updated successfully')" type="success" />
</section>
