<?php

namespace BoShurik\TelegramBotBundle\Telegram\Command\Result;

class Unmatched implements CommandResultInterface
{
    const STATUS_UNMATCHED = 'unmatched';

    /**
     * {@inheritdoc}
     */
    public function getStatus()
    {
        return self::STATUS_UNMATCHED;
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
        return false;
    }
}
