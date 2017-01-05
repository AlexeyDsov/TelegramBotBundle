<?php

namespace BoShurik\TelegramBotBundle\Telegram\Command;

use BoShurik\TelegramBotBundle\Telegram\Command\Result\Unmatched;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Message;

class NamedCommandDecorator implements CommandInterface
{
    /**
     * RegExp for bot commands
     */
    const REGEXP = '/^([^\s@]+)(@\S+)?\s?(.*)$/u';

    /**
     * @var CommandInterface
     */
    private $command;

    /**
     * @var string
     */
    private $commandName;

    /**
     * @var string[]
     */
    private $commandNameAliases;

    /**
     * @param CommandInterface $command
     * @param string $commandName
     * @param string[] $aliases
     */
    public function __construct(CommandInterface $command, $commandName, array $aliases = [])
    {
        $this->command = $command;
        $this->commandName = $commandName;
        $this->commandNameAliases = $aliases;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BotApi $api, Message $message)
    {
        if (is_null($message) || !strlen($message->getText())) {
            return new Unmatched();
        }

        if ($this->matchCommandName($message->getText(), $this->commandName)) {
            return $this->command->execute($api, $message);
        }

        foreach ($this->commandNameAliases as $alias) {
            if ($this->matchCommandName($message->getText(), $alias)) {
                return $this->command->execute($api, $message);
            }
        }

        return new Unmatched();
    }

    /**
     * @param string $text
     * @param string $name
     * @return bool
     */
    private function matchCommandName($text, $name)
    {
        preg_match(self::REGEXP, $text, $matches);

        return !empty($matches) && $matches[1] == $name;
    }
}
