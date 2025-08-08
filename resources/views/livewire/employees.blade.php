<section class="w-full">
    <div>
        <flux:heading size="xl" level="1" class="mb-5">{{ __('Employees') }}</flux:heading>

        <div>
            <x-table class="mb-4 w-full">
                <x-slot:head>
                    <x-table.heading class="w-1"></x-table.heading>
                    <x-table.heading wire:click="sort('name')" class="cursor-pointer">{{ __('Employee') }}</x-table.heading>
                    <x-table.heading wire:click="sort('phone')" class="cursor-pointer">{{ __('Phone') }}</x-table.heading>
                    <x-table.heading wire:click="sort('created_at')" class="cursor-pointer">{{ __('Date registered') }}</x-table.heading>
                </x-slot:head>

                @foreach ($this->employees as $employee)
                    <x-table.row :key="$employee->id">
                        <x-table.cell>
                            <flux:button variant="ghost" size="sm" icon="pencil" href="{{ route('employees.edit', $employee) }}" wire:navigate />
                        </x-table.cell>
                        <x-table.cell> {{ $employee->name }} </x-table.cell>
                        <x-table.cell> {{ $employee->phone }} </x-table.cell>
                        <x-table.cell class="whitespace-nowrap">{{ Helper::formatDatetime($employee->created_at) }}</x-table.cell>
                    </x-table.row>
                @endforeach
            </x-table>

            {{ $this->employees->links() }}
        </div>

        <div wire:loading>
            <flux:icon.loading />
        </div>

    </div>
</section>
