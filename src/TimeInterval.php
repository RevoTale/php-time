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

    final public static function inSeconds(int $amount): self
    {
        /* @noinspection PhpUnhandledExceptionInspection */
        return new self('PT'.$amount.'S');
    }

    final public static function day(int $amount = 1): self
    {
        return self::inSeconds(self::SECONDS_IN_DAY * $amount);
    }

    final public static function hour(int $amount = 1): self
    {
        return self::inSeconds(self::SECONDS_IN_HOUR * $amount);
    }

    final public static function minute(int $amount = 1): self
    {
        return self::inSeconds(self::SECONDS_IN_MINUTE * $amount);
    }

    final public static function second(int $amount = 1): self
    {
        return self::inSeconds($amount);
    }

    final public static function week(int $amount = 1): self
    {
        return self::inSeconds(self::SECONDS_IN_WEEK * $amount);
    }
}
