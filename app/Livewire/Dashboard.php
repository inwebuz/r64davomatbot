<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\WorkTime;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Dashboard extends Component
{
    public array $ranges = [
        'current-month' => 'Current month',
        'last-month' => 'Last month',
        'current-year' => 'Last year',
    ];

    public array $filters = [
        'user_id' => null,
        'date_range' => null,
    ];

    public function updatingFilters()
    {
        // $this->resetPage();
    }

    public function render()
    {
        $query = User::role('employee');
        $allEmployees = $query->orderBy('name')->get();


        if ($this->filters['user_id']) {

            $query->where('id', $this->filters['user_id']);
        }

        $stats = collect();
        $from = now()->startOfMonth();
        $to = now()->endOfMonth();
        if ($this->filters['date_range']) {
            $range = explode(' - ', $this->filters['date_range']);
            $from = \Carbon\Carbon::parse($range[0])->startOfDay();
            if (!empty($range[1])) {
                $to = \Carbon\Carbon::parse($range[1])->endOfDay();
            } else {
                $to = $from->copy()->endOfDay();
            }
        }
        $query = WorkTime::whereBetween('start_time', [$from, $to]);
        if ($this->filters['user_id']) {
            $query->where('user_id', $this->filters['user_id']);
        }
        $workTimes = $query->get();

        $filterEmployees = $this->filters['user_id'] ? $allEmployees->where('id', $this->filters['user_id']) : $allEmployees;

        foreach ($filterEmployees as $employee) {
            $employeeWorkTimes = $workTimes->where('user_id', $employee->id);
            $stats->put($employee->id, collect([
                'employee' => $employee,
                'totalHours' => $employeeWorkTimes->sum('duration'),
                'totalDays' =>  $employeeWorkTimes
                    ->groupBy(fn($wt) => \Carbon\Carbon::parse($wt->start_time)->toDateString())
                    ->count(),
            ]));
        }

        return view('livewire.dashboard', compact('allEmployees', 'workTimes', 'stats'));
    }
}
