<?php

/** @noinspection PhpUnused */

declare(strict_types=1);

namespace BladL\Time;

use function assert;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;

/**
 * Class Moment.
 * Time zone is required. If you need not timezone use universal. @see TimeZone::universal().
 *
 * @psalm-immutable
 */
final class Moment extends DateTimeImmutable
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

    public static function now(): self
    {
        return TimeZone::universal()->now();
    }

    /**
     * @deprecated use Moment::fromUnix
     */
    public static function unixToUniversal(int $time): self
    {
        return TimeZone::universal()->unix($time);
    }

    public static function fromDateTime(DateTimeInterface $object): self
    {
        return self::fromUnix($object->getTimestamp());
    }

    public static function fromUnix(int $time): self
    {
        return TimeZone::universal()->unix($time);
    }

    public function laterThan(Moment $moment): bool
    {
        return $this->getTimestamp() > $moment->getTimestamp();
    }

    public function earlierThan(Moment $moment): bool
    {
        return $this->getTimestamp() < $moment->getTimestamp();
    }

    public static function fromFormat(string $format, string $datetime, TimeZone $timeZone): self
    {
        $date_time = parent::createFromFormat($format, $datetime, $timeZone);
        assert(false !== $date_time);

        return self::fromUnix($date_time->getTimestamp());
    }
}
