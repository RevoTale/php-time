<?php

declare(strict_types=1);

namespace Grisaia\Time;

use DateTimeImmutable;
use Exception;
use UnexpectedValueException;

/**
 * Class LocalTimestamp.
 */
final readonly class LocalTimestamp implements TimestampInterface
{
    use TimeTrait;

    /**
     * @internal
     */
    public function __construct(private TimeZone $timeZone, private Timestamp $timestamp)
    {
    }

    public function dayOfWeek(): DayOfWeek
    {
        return DayOfWeek::fromISO($this->dayOfWeekISO());
    }

    public function dayOfWeekISO(): int
    {
        return (int) $this->toNativeDateTime()->format('N');
    }

    public function hour24Int(): int
    {
        return (int) $this->toNativeDateTime()->format('G');
    }

    public function format(string $format): string
    {
        return $this->toNativeDateTime()->format($format);
    }

    public function toNativeDateTime(): DateTimeImmutable
    {
        $timestamp = $this->timestamp->getUnixSeconds();
        try {
            return (new DateTimeImmutable("@$timestamp"))->setTimezone($this->timeZone->toNativeDateTimeZone());
        } catch (Exception) {
            throw new UnexpectedValueException('Exception never thrown');
        }
    }

    public function hour24Zeros(): string
    {
        return $this->toNativeDateTime()->format('H');
    }

    public function setTime(int $hour, int $minute, int $second = 0): self
    {
        $datetime = $this->toNativeDateTime()->setTime(hour: $hour, minute: $minute, second: $second);

        return new self(timeZone: $this->timeZone, timestamp: new Timestamp(seconds: $datetime->getTimestamp()));
    }

    public function add(TimeInterval $interval): self
    {
        return new self(timeZone: $this->timeZone, timestamp: $this->timestamp->add($interval));
    }

    public function sub(TimeInterval $interval): self
    {
        return new self(timeZone: $this->timeZone, timestamp: $this->timestamp->sub($interval));
    }

    public function getUnix(): float
    {
        return $this->timestamp->getUnix();
    }

    public function getTimestamp(): Timestamp
    {
        return $this->timestamp;
    }

    public function getTimeZone(): TimeZone
    {
        return $this->timeZone;
    }

    public function getInternalTimeValue(): float
    {
        return $this->timestamp->getInternalTimeValue();
    }
}
