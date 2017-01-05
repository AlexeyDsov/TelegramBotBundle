<?php

namespace BoShurik\TelegramBotBundle\Telegram\Command\Result;

class Matched implements CommandResultInterface
{
    const STATUS_MATCHED = 'matched';

    /**
     * {@inheritdoc}
     */
    public function getStatus()
    {
        return self::STATUS_MATCHED;
    }

    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function isMatched()
    {
        return true;
    }
}
