<?php

namespace App\Telegram\Conversations;

use App\Helpers\Bot;
use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use SergiX44\Nutgram\Conversations\Conversation;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Keyboard\KeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\ReplyKeyboardMarkup;

class StartConversation extends Conversation
{
    public $registerData;

    public function start(Nutgram $bot)
    {
        $user = User::where('telegram_id', $bot->userId())->first();
        if ($user) {
            Bot::mainMenu($bot);
            $this->end();
            return;
        }

        $this->askName($bot);
        $this->next('secondStep');
    }

    public function secondStep(Nutgram $bot)
    {
        $message = $bot->message();
        $text = $message->text;
        if (!$text) {
            $this->askName($bot);
            return;
        }
        $this->registerData['name'] = $text;
        $this->askPhone($bot);
        $this->next('thirdStep');
    }

    public function thirdStep(Nutgram $bot)
    {
        $message = $bot->message();
        $contact = $message->contact;
        if (! $contact) {
            $this->askPhone($bot);
            return;
        }
        $phone = Helper::formatPhone($contact->phone_number);
        if (! $phone) {
            $this->askPhone($bot);
            return;
        }

        // create user
        $user = User::create([
            'name' => $this->registerData['name'],
            'email' => $phone . '@' . Helper::removeHttp(config('app.url')),
            'password' => Hash::make(Str::random(10)),
            'telegram_id' => $bot->userId(),
            'phone' => $phone,
        ]);
        $user->assignRole('employee');

        // welcome message
        $bot->sendMessage(text: __('Welcome!'));
        Bot::mainMenu($bot);
        $this->end();
    }

    private function askPhone(Nutgram $bot)
    {
        $bot->sendMessage(text: __('Your phone'), reply_markup: ReplyKeyboardMarkup::make(resize_keyboard: true)->addRow(
            KeyboardButton::make(text: __('Send phone number'), request_contact: true),
        ));
    }

    private function askName(Nutgram $bot)
    {
        $bot->sendMessage(text: __('Your name'), reply_markup: ReplyKeyboardMarkup::make(resize_keyboard: true)->addRow(
            KeyboardButton::make(trim($bot->user()->first_name . ' ' . $bot->user()->last_name)),
        ));
    }
}
