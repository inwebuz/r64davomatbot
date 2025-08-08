<?php

namespace App\Livewire;

use App\Helpers\Helper;
use App\Models\WorkTime;
use Livewire\Component;

class WorkTimesEdit extends Component
{
    public WorkTime $workTime;

    public string $startTime;
    public string|null $endTime;

    public function mount(WorkTime $workTime)
    {
        $this->workTime = $workTime;
        $this->startTime = Helper::formatDatetime($workTime->start_time);
        $this->endTime = $workTime->end_time ? Helper::formatDatetime($workTime->end_time) : null;
    }

    public function render()
    {
        return view('livewire.work-times-edit');
    }

    public function update()
    {
        $this->workTime->update([
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
        ]);

        $this->dispatch('work-time-updated');
    }
}
