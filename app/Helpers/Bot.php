<?php

namespace App\Helpers;

use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Keyboard\KeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\ReplyKeyboardMarkup;

class Bot
{
    public static function mainMenu(Nutgram $bot)
    {
        $bot->sendMessage(text: __('Choose an option'), reply_markup: ReplyKeyboardMarkup::make(resize_keyboard: true)
            ->addRow(
                KeyboardButton::make(__('Start work')),
                KeyboardButton::make(__('End work')),
            ));
    }
}
