<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class EmployeesEdit extends Component
{
    public User $employee;

    public string $name;
    public string $phone;

    public function mount(User $employee)
    {
        $this->employee = $employee;
        $this->name = $employee->name;
        $this->phone = $employee->phone;
    }

    public function render()
    {
        return view('livewire.employees-edit');
    }

    public function update()
    {
        $this->employee->update([
            'name' => $this->name,
            'phone' => $this->phone,
        ]);

        $this->dispatch('user-updated');
    }
}
