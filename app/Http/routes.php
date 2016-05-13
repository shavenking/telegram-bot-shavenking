<?php

$app->get('set-webhook:' . env('TELEGRAM_BOT_TOKEN'), function () use ($app) {
    $url = route('webhook');

    $telegram = $app->make(\Telegram\Bot\Api::class, [env('TELEGRAM_BOT_TOKEN')]);

    $rep = $telegram->setWebhook(compact('url'));

    return 'ok';
});

$app->post('/webhook:' . env('TELEGRAM_BOT_TOKEN'), ['as' => 'webhook', function () use ($app) {
    $telegram = $app->make(\Telegram\Bot\Api::class, [env('TELEGRAM_BOT_TOKEN')]);

    if ($app['request']->has('message')) {
        $message = $app['request']->input('message');

        $chatId = $message['chat']['id'];

        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => 'ok'
        ]);
    }

    return;
}]);
