<?php

namespace App\Console\Commands;

use App\Models\WorkTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class EndWorkTimes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'work-times:end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Log::info('Ending work times');
        $now = now();
        $start = now()->startOfDay();
        $endTime = now()->setHour(19)->setMinute(0)->setSecond(0);
        if ($now->isAfter($endTime)) {
            WorkTime::where('start_time', '>=', $start)->whereNull('end_time')->update(['end_time' => $endTime]);
        }
    }
}
