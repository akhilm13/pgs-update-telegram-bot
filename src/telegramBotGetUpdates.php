<?php

/**
 * Created by PhpStorm.
 * User: akmur
 * Date: 15-06-2020
 * Time: 01:16
 */


use Longman\TelegramBot\Request;

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Config.php';

// Define all paths for your custom commands in this array (leave as empty array if not used)
$commands_paths = [
    __DIR__ . '/Commands/',
];


try {

    //get API key and bot username
    $config = new Config();

    $bot_api_key = $config->getBotApiKey();
    $bot_username = $config->getBotUsername();

    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    $telegram->useGetUpdatesWithoutDatabase();
    // Add commands paths containing your custom commands
    $telegram->addCommandsPaths($commands_paths);

    Request::setClient(new \GuzzleHttp\Client([
        'base_uri' => 'https://api.telegram.org',
        'verify'   => false,
    ]));
    // Handle telegram getUpdates request
    while(true){
    	$server_response = $telegram->handleGetUpdates();
    	if ($server_response->isOk()) {
        	$update_count = count($server_response->getResult());
        	echo date('Y-m-d H:i:s', time()) . ' - Processed ' . $update_count . ' updates';
    	} else {
        	echo date('Y-m-d H:i:s', time()) . ' - Failed to fetch updates' . PHP_EOL;
        	echo $server_response->printError();
    	}
		sleep(5);
	}
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    echo $e->getMessage();
    // Log telegram errors
    Longman\TelegramBot\TelegramLog::error($e);
} catch (Longman\TelegramBot\Exception\TelegramLogException $e) {
    // Catch log initialisation errors
    echo $e->getMessage();
}
