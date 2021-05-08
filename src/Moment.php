<?php

declare(strict_types=1);

namespace BladL\Time;

use DateTimeImmutable;
use DateTimeZone;

/**
 * Class Moment.
 * Time zone is required. If you need not timezone use universal. @see TimeZone::universal().
 *
 * @psalm-immutable
 */
class Moment extends DateTimeImmutable
{
    public function __construct(DateTimeZone $timezone, string $datetime = 'now')
    {
        parent::__construct($datetime, $timezone);
    }

    public function dayOfWeek(): DayOfWeek
    {
        return DayOfWeek::fromISO($this->dayOfWeekISO());
    }

    public function dayOfWeekISO(): int
    {
        return (int) $this->format('N');
    }

    public function hour24Int(): int
    {
        return (int) $this->format('G');
    }

    public function hour24Zeros(): string
    {
        return $this->format('H');
    }

    public static function unixToUniversal(int $time): self
    {
        return TimeZone::universal()->unix($time);
    }
}
