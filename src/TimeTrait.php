<?php

declare(strict_types=1);

namespace BladL\Time;

trait TimeTrait
{
    public function equals(TimestampInterface $timestamp, float $accuracy = 1): bool
    {
        $a = $this->_getInternalTimeValue();
        $b = $timestamp->_getInternalTimeValue();

        return abs(($a - $b) / $b) <= $accuracy;
    }

    public function isBetween(TimestampInterface $timestamp1, TimestampInterface $timestamp2): bool
    {
        $seconds1 = $timestamp1->_getInternalTimeValue();
        $seconds2 = $timestamp2->_getInternalTimeValue();
        $current = $this->_getInternalTimeValue();

        return min($seconds1, $seconds2) < $current && $current < max($seconds1, $seconds2);
    }

    public function diff(TimestampInterface $timestamp): TimeInterval
    {
        return TimeInterval::fromFloatingSeconds(abs($timestamp->_getInternalTimeValue() - $this->_getInternalTimeValue()));
    }

    public function laterThan(TimestampInterface $moment): bool
    {
        return $this->_getInternalTimeValue() > $moment->_getInternalTimeValue();
    }

    public function earlierThan(TimestampInterface $moment): bool
    {
        return $this->_getInternalTimeValue() < $moment->_getInternalTimeValue();
    }

    public function getUnixSeconds(): int
    {
        return (int) $this->_getInternalTimeValue();
    }

    /**
     * @return int amount of minutes since unix epoch
     */
    public function getUnixMinutes(): int
    {
        return (int) floor($this->getUnixSeconds() / TimeInterval::SECONDS_IN_MINUTE);
    }

    /**
     * @return int amount of hours since unix epoch
     */
    public function getUnixHours(): int
    {
        return (int) floor($this->getUnixMinutes() / TimeInterval::SECONDS_IN_MINUTE);
    }
}
