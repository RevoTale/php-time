<?php

/** @noinspection PhpUnused */

declare(strict_types=1);

namespace BladL\Time;

use function assert;
use DateInterval;
use Error;
use Exception;

/**
 * Class TimeInterval.
 */
final class TimeInterval implements TimeValueInterface
{
    public const MILLISECONDS_IN_SECOND = 1000;
    public const MICROSECONDS_IN_MILLISECOND = 1000;

    public const SECONDS_IN_MINUTE = 60;
    public const SECONDS_IN_HOUR = self::SECONDS_IN_MINUTE * 60;
    public const SECONDS_IN_DAY = self::SECONDS_IN_HOUR * 24;
    public const SECONDS_IN_WEEK = self::SECONDS_IN_DAY * 7;

    /**
     * @param float $seconds
     *
     * @internal
     */
    private function __construct(private readonly float $seconds)
    {
        assert($this->seconds >= 0.0);
    }

    public static function millisecond(int $amount = 1): self
    {
        return new TimeInterval($amount * self::MILLISECONDS_IN_SECOND);
    }

    public function getMicroseconds(): int
    {
        return self::MICROSECONDS_IN_MILLISECOND * $this->getMilliseconds();
    }

    public function getMilliseconds(): int
    {
        return (int) (self::MILLISECONDS_IN_SECOND * $this->seconds);
    }

    public function getSeconds(): int
    {
        return (int) ($this->seconds);
    }

    public function getMinutes(): int
    {
        return (int) ($this->getSeconds() / self::SECONDS_IN_MINUTE);
    }

    public static function inSeconds(int $amount): self
    {
        return new self(seconds: $amount);
    }

    public static function fromFloatingSeconds(float $seconds): self
    {
        return new self(seconds: $seconds);
    }

    public static function day(int $amount = 1): self
    {
        return self::inSeconds(self::SECONDS_IN_DAY * $amount);
    }

    public static function hour(int $amount = 1): self
    {
        return self::inSeconds(self::SECONDS_IN_HOUR * $amount);
    }

    public static function minute(int $amount = 1): self
    {
        return self::inSeconds(self::SECONDS_IN_MINUTE * $amount);
    }

    public static function second(int $amount = 1): self
    {
        return self::inSeconds($amount);
    }

    public function toNativeDateInterval(): DateInterval
    {
        try {
            return new DateInterval('PT'.$this->getSeconds().'S');
        } catch (Exception) {
            throw new Error('No exceptions');
        }
    }

    public static function week(int $amount = 1): self
    {
        return self::inSeconds(self::SECONDS_IN_WEEK * $amount);
    }

    public function format(string $format): string
    {
        return $this->toNativeDateInterval()->format($format);
    }

    public function _getInternalTimeValue(): float
    {
        return $this->seconds;
    }
}
