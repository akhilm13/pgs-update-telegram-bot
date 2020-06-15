<?php
/**
 * Created by PhpStorm.
 * User: akmur
 * Date: 15-06-2020
 * Time: 12:32
 */

namespace Longman\TelegramBot\Commands\SystemCommands;


use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;

class UpdateCommandextends extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'update';

    /**
     * @var string
     */
    protected $description = 'Update Feed command';

    /**
     * @var string
     */
    protected $usage = '/update';

    /**
     * @var string
     */
    protected $version = '1.1.0';

    /**
     * @var bool
     */
    protected $private_only = true;

    private $feedReader;

    /**
     * Command execute method
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $message = $this->getMessage();

        $chat_id = $message->getChat()->getId();
        $text = 'The feed will be updated.';


        $data = [
            'chat_id' => $chat_id,
            'text' => $text,
        ];

        return Request::sendMessage($data);
    }
}