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
final class Moment implements MomentInterface
{
    public function __construct(private readonly int $unix)
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

    public function laterThan(MomentInterface $moment): bool
    {
        return $this->getUnix() > $moment->getUnix();
    }

    public function earlierThan(MomentInterface $moment): bool
    {
        return $this->getUnix() < $moment->getUnix();
    }

    public function add(TimeInterval $interval): self
    {
        return new self(unix: (int) ($this->unix + $interval->getMicroseconds()));
    }

    public function sub(TimeInterval $interval): self
    {
        return new self(unix: (int) ($this->unix - $interval->getMicroseconds()));
    }

    public function withTimeZone(TimeZone $timeZone): TimeZoneMoment
    {
        return $timeZone->getTimeZoned($this);
    }

    public static function fromFormat(string $format, string $datetime, TimeZone $timeZone): self
    {
        $dateTime = DateTimeImmutable::createFromFormat($format, $datetime, $timeZone->toNative());
        assert(false !== $dateTime);

        return self::fromUnix($dateTime->getTimestamp());
    }

    public function getUnix(): int
    {
        return $this->unix;
    }

    public function toNativeDateTime(): DateTimeImmutable
    {
        $timestamp = $this->getUnix();

        try {
            return new DateTimeImmutable("@$timestamp", TimeZone::UTC->toNative());
        } catch (Exception) {
            throw new UnexpectedValueException('Exception never thrown');
        }
    }
}
