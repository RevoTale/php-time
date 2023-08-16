<?php
declare(strict_types=1);

namespace Grisaia\Time;

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
    use TimeTrait;

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

    public function add(TimeInterval $interval): self
    {
        return new self(seconds: $this->_getInternalTimeValue() + $interval->_getInternalTimeValue());
    }

    public function sub(TimeInterval $interval): self
    {
        return new self(seconds: $this->getUnix() - $interval->_getInternalTimeValue());
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

    public function getUnixMilliseconds(): int
    {
        return (int) ($this->seconds * TimeInterval::MILLISECONDS_IN_SECOND);
    }

    public function toNativeDateTime(): DateTimeImmutable
    {
        $timestamp = $this->getUnixSeconds();

        try {
            return new DateTimeImmutable("@$timestamp");
        } catch (Exception) {
            throw new UnexpectedValueException('Exception never thrown');
        }
    }

    public function _getInternalTimeValue(): float
    {
        return $this->seconds;
    }
}
