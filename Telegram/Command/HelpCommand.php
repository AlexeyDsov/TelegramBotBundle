<?php
/**
 * User: boshurik
 * Date: 25.04.16
 * Time: 14:05
 */

namespace BoShurik\TelegramBotBundle\Telegram\Command;

use RuntimeException;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Message;

class HelpCommand implements CommandInterface
{
    /**
     * @var CommandPool
     */
    private $commandPool;

    /**
     * @var string
     */
    private $description;

    /**
     * @var array
     */
    private $aliases;

    public function __construct(CommandPool $commandPool, $description = 'Help', $aliases = array())
    {
        $this->commandPool = $commandPool;
        $this->description = $description;
        $this->aliases = $aliases;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BotApi $api, Message $message)
    {
        throw new RuntimeException(sprintf("'%s' not yet implemented", __CLASS__));
//        $commands = $this->commandPool->getCommands();
//
//        $reply = '';
//        foreach ($commands as $command) {
//            if (!$command instanceof PublicCommandInterface) {
//                continue;
//            }
//
//            $reply .= sprintf("%s - %s\n", $command->getName(), $command->getDescription());
//        }
//
//        $api->sendMessage($message->getChat()->getId(), $reply);
//
//        return new Successful();
    }
}
