<?php

namespace BoShurik\TelegramBotBundle\Telegram\Command\Result;

interface CommandResultInterface
{
    /**
     * @return string
     */
    public function getStatus();

    /**
     * @return boolean
     */
    public function isSuccessful();

    /**
     * @return boolean
     */
    public function isMatched();
}
