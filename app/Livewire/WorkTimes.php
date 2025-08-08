<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\WorkTime;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class WorkTimes extends Component
{
    use WithPagination;

    public array $filters = [
        'user_id' => null,
    ];

    public function updatingFilters()
    {
        $this->resetPage();
    }

    public function render()
    {
        $employees = User::role('employee')->orderBy('name')->get();
        return view('livewire.work-times', compact('employees'));
    }

    #[\Livewire\Attributes\Computed]
    public function workTimes()
    {
        $query = WorkTime::with('user');
        if ($this->filters['user_id']) {
            $query->where('user_id', $this->filters['user_id']);
        }
        return $query->latest()->paginate(10);
    }

    public function deleteWorkTime($id)
    {
        $workTime = WorkTime::find($id);
        if ($workTime) {
            $workTime->delete();
        }

        $this->dispatch('work-time-deleted');
    }
}
