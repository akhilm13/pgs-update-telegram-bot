<?php
/**
 * Created by PhpStorm.
 * User: akmur
 * Date: 15-06-2020
 * Time: 01:24
 */

class Config
{
    private $botUsername;
    private $botApiKey;

    public function __construct()
    {
        $this->loadConfigurationValues();
    }

    private $fileName = __DIR__ . '/../config/params.yaml';

    private function loadConfigurationValues()
    {
        $configValues = yaml_parse_file($this->fileName);
        $this->botApiKey = $configValues['api_key'];
        $this->botUsername = $configValues['bot_username'];
    }

    /**
     * @return mixed
     */
    public function getBotApiKey()
    {
        return $this->botApiKey;
    }

    /**
     * @return mixed
     */
    public function getBotUsername()
    {
        return $this->botUsername;
    }
}
