<?php

namespace App\Core\Domain\Service;

interface UniquePaymentCodeInterface {
    /**
     * function to obtain the unique code payment by event type
     *
     * @param string $eventType
     * @return integer
     */
    public static function getByEventType(string $eventType) : int;
}
