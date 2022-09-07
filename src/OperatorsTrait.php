<?php

declare(strict_types=1);

namespace BladL\Time;

trait OperatorsTrait
{
    public function equals(TimestampInterface $timestamp, float $accuracy = 1): bool
    {
        $a = $this->getUnix();
        $b = $timestamp->getUnix();

        return abs(($a - $b) / $b) <= $accuracy;
    }

    public function isBetween(TimestampInterface $timestamp1, TimestampInterface $timestamp2): bool
    {
        $seconds1 = $timestamp1->getUnix();
        $seconds2 = $timestamp2->getUnix();
        $current = $this->getUnix();

        return min($seconds1, $seconds2) < $current && $current < max($seconds1, $seconds2);
    }

    public function diff(TimestampInterface $timestamp): TimeInterval
    {
        return TimeInterval::fromFloatingSeconds($timestamp->getUnix() - $this->getUnix());
    }

    public function laterThan(TimestampInterface $moment): bool
    {
        return $this->seconds > $moment->getUnix();
    }

    public function earlierThan(TimestampInterface $moment): bool
    {
        return $this->getUnix() < $moment->getUnix();
    }
}
