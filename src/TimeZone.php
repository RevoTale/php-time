<?php

declare(strict_types=1);
namespace BladL\Time;
use DateTimeZone;

/**
 * Class TimeZone.
 *
 * @psalm-immutable
 */
final class TimeZone extends DateTimeZone
{
    public function timeNow(): Moment
    {
        return (new Moment())->setTimezone($this);
    }

    /**
     * @psalm-pure
     */
    public static function universal(): self
    {
        return new self('UTC');
    }

    public function timeFromUnix(
        int $timestamp
    ): Moment {
        /* @noinspection PhpUnhandledExceptionInspection */
        return new Moment("@$timestamp", self::universal());
    }
}
