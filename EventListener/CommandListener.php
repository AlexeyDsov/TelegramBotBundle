<?php
/**
 * User: boshurik
 * Date: 30.05.16
 * Time: 18:03
 */

namespace BoShurik\TelegramBotBundle\EventListener;

use BoShurik\TelegramBotBundle\Event\Telegram\UpdateEvent;
use BoShurik\TelegramBotBundle\Telegram\Command\CommandInterface;
use TelegramBot\Api\BotApi;

class CommandListener
{
    /**
     * @var BotApi
     */
    private $api;

    /**
     * @var CommandInterface
     */
    private $command;

    /**
     * @param BotApi $api
     * @param CommandInterface $command
     */
    public function __construct(BotApi $api, CommandInterface $command)
    {
        $this->api = $api;
        $this->command = $command;
    }

    /**
     * @param UpdateEvent $event
     */
    public function onUpdate(UpdateEvent $event)
    {
        if (is_null($message = $event->getUpdate()->getMessage())) {
            return;
        }

        if ($this->command->execute($this->api, $message)->isMatched()) {
            $event->setProcessed();
        }
    }
}
