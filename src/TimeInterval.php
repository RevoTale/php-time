<?php

declare(strict_types=1);

/**
 * Class TimeInterval.
 */
final class TimeInterval extends DateInterval
{
    public const SECONDS_IN_MINUTE = 60;
    public const SECONDS_IN_HOUR = self::SECONDS_IN_MINUTE * 60;
    public const SECONDS_IN_DAY = self::SECONDS_IN_HOUR * 24;
    public const SECONDS_IN_WEEK = self::SECONDS_IN_DAY * 7;

    public static function fromSeconds(int $amount): self
    {
        /* @noinspection PhpUnhandledExceptionInspection */
        return new self('PT'.$amount.'S');
    }
}
