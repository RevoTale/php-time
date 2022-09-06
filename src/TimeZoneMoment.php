<?php

declare(strict_types=1);

namespace BladL\Time;

use function assert;
use DateTimeImmutable;
use Exception;
use UnexpectedValueException;

/**
 * Class TimeZoneMoment.
 */
final class TimeZoneMoment implements MomentInterface
{
    /**
     * @internal
     */
    public function __construct(private readonly TimeZone $timeZone, private readonly Moment $moment)
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
        $timestamp = $this->moment->getTimestamp();

        try {
            return new DateTimeImmutable("@$timestamp", $this->timeZone->toNativeDateTimeZone());
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
        assert(false !== $datetime);

        return new self(timeZone: $this->timeZone, moment: Moment::fromUnix($datetime->getTimestamp()));
    }

    public function laterThan(MomentInterface $moment): bool
    {
        return $this->moment->laterThan($moment);
    }

    public function earlierThan(MomentInterface $moment): bool
    {
        return $this->moment->earlierThan($moment);
    }

    public function add(TimeInterval $interval): self
    {
        return new self(timeZone: $this->timeZone, moment: $this->moment->add($interval));
    }

    public function getFloatingSeconds(): float
    {
        return $this->moment->getFloatingSeconds();
    }

    public function sub(TimeInterval $interval): self
    {
        return new self(timeZone: $this->timeZone, moment: $this->moment->sub($interval));
    }

    public function getTimestamp(): int
    {
        return $this->moment->getTimestamp();
    }

    public function getMoment(): Moment
    {
        return $this->moment;
    }

    public function getTimeZone(): TimeZone
    {
        return $this->timeZone;
    }
}
