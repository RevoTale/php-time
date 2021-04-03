<?php
declare(strict_types=1);


/**
 * Class TimeZone
 */
final class TimeZone extends DateTimeZone
{
    public function timeNow():Moment {
        return (new Moment())->setTimezone($this);
    }
    public static function universal():self {
        return new self('UTC');
    }
    public function timeFromUnix(
        int $timestamp
    ): Moment
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return new Moment("@$timestamp", self::universal());
    }
}
