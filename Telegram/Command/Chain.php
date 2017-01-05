<?php

namespace BoShurik\TelegramBotBundle\Telegram\Command;

use BoShurik\TelegramBotBundle\Telegram\Command\Result\Unmatched;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Message;

class Chain implements CommandInterface
{
    /**
     * @var CommandInterface[]
     */
    private $commands;

    /**
     * @param CommandInterface[] $commands
     */
    public function __construct(array $commands = [])
    {
        $this->commands = $commands;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BotApi $api, Message $message)
    {
        foreach ($this->commands as $command) {
            $result = $command->execute($api, $message);

            if ($result->isMatched()) {
                return $result;
            }
        }

        return new Unmatched();
    }
}
