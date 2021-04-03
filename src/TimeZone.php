<?php

declare(strict_types=1);

namespace BladL\Time;

use DateTimeZone;

/**
 * Class TimeZone.
 *
 * @psalm-immutable
 */
class TimeZone extends DateTimeZone
{
    /**
     * @psalm-pure
     */
    public static function universal(): self
    {
        return new self('UTC');
    }

    public function now(): Moment
    {
        /* @noinspection PhpUnhandledExceptionInspection */
        return new Moment($this);
    }

    public function unix(
        int $timestamp
    ): Moment {
        /* @noinspection PhpUnhandledExceptionInspection */
        return new Moment($this, "@$timestamp");
    }
}
