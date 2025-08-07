<?php

namespace App\Telegram\Commands;

use App\Helpers\Helper;
use App\Models\User;
use App\Models\WorkTime;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Handlers\Type\Command;

class EndWorkCommand extends Command
{
    protected string $command = 'endwork';

    protected ?string $description = 'End work';

    public function handle(Nutgram $bot): void
    {
        $user = User::where('telegram_id', $bot->userId())->first();
        if (!$user) {
            $bot->sendMessage(__('You are not registered'));
            return;
        }
        $workTime = WorkTime::whereNull('end_time')->where('user_id', $user->id)->first();
        if (!$workTime) {
            $bot->sendMessage(__('You have not started work'));
            return;
        }
        $workTime->end_time = now();
        $workTime->save();
        $message = __('Start work time') . ': ' . Helper::formatDatetime($workTime->start_time) . "\n";
        $message .= __('End work time') . ': ' . Helper::formatDatetime($workTime->end_time);
        $bot->sendMessage($message);
    }
}
