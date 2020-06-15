<?php
/**
 * Created by PhpStorm.
 * User: akmur
 * Date: 15-06-2020
 * Time: 13:05
 */
use Longman\TelegramBot\Request;
require_once __DIR__ . '/DataManager.php';
require_once __DIR__ . '/PollWordPressRSSFeed.php';

class NotifyReaders
{
	private $dataManager;

	public function __construct(){
	
		$this->dataManager = new DataManager();
	}

	public function notifyAllUsers(){
		
		$users = $this->dataManager->getAllUsers();
		$text = $this->getTextWithLinkToSend();
		foreach($users as $user){

	
			$data = [
          			'chat_id' => $user,
            			'text' => $text,
        		];
			Request::send('sendMessage', $data);	
			
		}		
		
	}

	private function getTextWithLinkToSend(){
	
		$text = 'Hello there! A new post has been published. Here\'s the link. Happy Reading!' . PHP_EOL;	
		$wpFeed = new PollWordPressRSSFeed();
		$link = $wpFeed->getLatestLink();
		$text .= $link;

		return $text;
		
	}	

}
