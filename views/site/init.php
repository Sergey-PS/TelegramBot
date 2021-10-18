<?php

use app\components\CatOrDog;
use app\components\TelegramBot;

$telegramApi = new TelegramBot();
$catOrDog = new CatOrDog();

while (true) {
    sleep(2);
    $updates = $telegramApi->getUpdates();
    foreach ($updates as $update) {
        $result = $catOrDog->getCatOrDog($update->message->text);
        $telegramApi->sendMessages($update->message->chat->id, $result);
    }
}
