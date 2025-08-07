<?php
/** @var SergiX44\Nutgram\Nutgram $bot */

use App\Telegram\Commands\EndWorkCommand;
use App\Telegram\Commands\StartWorkCommand;
use App\Telegram\Conversations\StartConversation;
use SergiX44\Nutgram\Nutgram;

/*
|--------------------------------------------------------------------------
| Nutgram Handlers
|--------------------------------------------------------------------------
|
| Here is where you can register telegram handlers for Nutgram. These
| handlers are loaded by the NutgramServiceProvider. Enjoy!
|
*/

$bot->onCommand('start', StartConversation::class);

$bot->onCommand('startwork', StartWorkCommand::class);
$bot->onText(__('Start work'), StartWorkCommand::class);

$bot->onCommand('endwork', EndWorkCommand::class);
$bot->onText(__('End work'), EndWorkCommand::class);
