<?php

namespace App\Telegram\Commands;

use App\Helpers\Helper;
use App\Models\User;
use App\Models\WorkTime;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Handlers\Type\Command;

class StartWorkCommand extends Command
{
    protected string $command = 'startwork';

    protected ?string $description = 'Start work.';

    public function handle(Nutgram $bot): void
    {
        $user = User::where('telegram_id', $bot->userId())->first();
        if (!$user) {
            $bot->sendMessage(__('You are not registered'));
            return;
        }
        $workTime = WorkTime::create([
            'user_id' => $user->id,
            'start_time' => now(),
        ]);
        $bot->sendMessage(__('Start work time') . ': ' . Helper::formatDatetime($workTime->start_time));
    }
}
