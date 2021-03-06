<?php

namespace Shotbow\ChatBot\Test\Helper;

class Bot extends \Shotbow_ChatBot_Bot
{
    private $messages = [];

    public function process(\Shotbow_ChatBot_User $sender, $message)
    {
        static::outputDebug($message, $sender->getName());
        $this->messages = [];
        parent::process($sender, $message);

        return $this->messages;
    }

    public static function outputDebug($message, $name)
    {
        if (defined('DEBUG')) {
            echo "[MSG] <{$name}> {$message}".PHP_EOL;
        }
    }

    public function postMessage($message, $name = null)
    {
        parent::postMessage($message, $name);
        $name = is_null($name) ? static::INFO_NAME : $name;
        $this->messages[] = [$message, $name];
        static::outputDebug($message, $name);
    }

    public function postAction($action, $name = null)
    {
        parent::postAction($action, $name);
        $name = is_null($name) ? static::INFO_NAME : $name;
        $action .= "/me {$action}";
        $this->messages[] = [$action, $name];
        static::outputDebug($action, $name);
    }

    public function getCommandList()
    {
        return parent::getCommandList();
    }
}
