<?php

declare(strict_types=1);

namespace BladL\Time;

use DateInterval;

/**
 * Class TimeInterval.
 */
class TimeInterval extends DateInterval
{
    public const SECONDS_IN_MINUTE = 60;
    public const SECONDS_IN_HOUR = self::SECONDS_IN_MINUTE * 60;
    public const SECONDS_IN_DAY = self::SECONDS_IN_HOUR * 24;
    public const SECONDS_IN_WEEK = self::SECONDS_IN_DAY * 7;

    public static function inSeconds(int $amount): self
    {
        /* @noinspection PhpUnhandledExceptionInspection */
        return new self('PT'.$amount.'S');
    }
}
