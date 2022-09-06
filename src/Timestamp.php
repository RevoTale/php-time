<?php

/** @noinspection PhpUnused */

declare(strict_types=1);

namespace BladL\Time;

use function assert;
use DateTimeImmutable;
use DateTimeInterface;
use Exception;
use UnexpectedValueException;

/**
 * Class Moment.
 */
final class Timestamp implements TimestampInterface
{
    /**
     * @internal
     */
    public function __construct(private readonly float $seconds)
    {
    }

    public static function now(): self
    {
        return new self(time());
    }

    public static function fromDateTime(DateTimeInterface $object): self
    {
        return self::fromUnix($object->getTimestamp());
    }

    /**
     * @param int $time in seconds
     */
    public static function fromUnix(int $time): self
    {
        return new self($time);
    }

    public function laterThan(TimestampInterface $moment): bool
    {
        return $this->seconds > $moment->getUnix();
    }

    /**
     * @internal
     */
    public function getFloatingSeconds(): float
    {
        return $this->seconds;
    }

    public function earlierThan(TimestampInterface $moment): bool
    {
        return $this->getFloatingSeconds() < $moment->getFloatingSeconds();
    }

    public function add(TimeInterval $interval): self
    {
        return new self(seconds: $this->getFloatingSeconds() + $interval->getFloatingSeconds());
    }

    public function sub(TimeInterval $interval): self
    {
        return new self(seconds: $this->getFloatingSeconds() - $interval->getFloatingSeconds());
    }

    public function withTimeZone(TimeZone $timeZone): LocalTimestamp
    {
        return $timeZone->getTimeZoned($this);
    }

    public static function fromFormat(string $format, string $datetime, TimeZone $timeZone): self
    {
        $dateTime = DateTimeImmutable::createFromFormat($format, $datetime, $timeZone->toNativeDateTimeZone());
        assert(false !== $dateTime);

        return self::fromUnix($dateTime->getTimestamp());
    }

    public function getUnix(): float
    {
        return $this->seconds;
    }

    public function getSeconds(): int
    {
        return (int) $this->seconds;
    }

    public function getMilliseconds(): int
    {
        return (int) ($this->seconds * TimeInterval::MILLISECONDS_IN_SECOND);
    }

    /**
     * @return int amount of minutes since unix epoch
     */
    public function getMinutes(): int
    {
        return (int) floor($this->getSeconds() / TimeInterval::SECONDS_IN_MINUTE);
    }

    /**
     * @return int amount of hours since unix epoch
     */
    public function getHours(): int
    {
        return (int) floor($this->getMinutes() / TimeInterval::SECONDS_IN_MINUTE);
    }

    public function toNativeDateTime(): DateTimeImmutable
    {
        $timestamp = $this->getUnix();

        try {
            return new DateTimeImmutable("@$timestamp", TimeZone::UTC->toNativeDateTimeZone());
        } catch (Exception) {
            throw new UnexpectedValueException('Exception never thrown');
        }
    }
}
