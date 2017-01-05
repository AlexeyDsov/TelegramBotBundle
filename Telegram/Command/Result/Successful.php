<?php

namespace BoShurik\TelegramBotBundle\Telegram\Command\Result;

class Successful implements CommandResultInterface
{
    const STATUS_SUCCESSFUL = 'successful';

    /**
     * {@inheritdoc}
     */
    public function getStatus()
    {
        return self::STATUS_SUCCESSFUL;
    }

    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isMatched()
    {
        return true;
    }
}
