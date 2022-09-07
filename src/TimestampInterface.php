<?php

declare(strict_types=1);

namespace BladL\Time;

use DateTimeImmutable;

/**
 * Basic methods of moment.
 */
interface TimestampInterface
{
    public function laterThan(TimestampInterface $moment): bool;

    public function earlierThan(TimestampInterface $moment): bool;

    public function add(TimeInterval $interval): TimestampInterface;

    public function sub(TimeInterval $interval): TimestampInterface;

    public function diff(TimestampInterface $timestamp): TimeInterval;

    public function isBetween(TimestampInterface $timestamp1, TimestampInterface $timestamp2): bool;

    /**
     * @param float $accuracy Accuracy in seconds. To specify milliseconds do 0.0001. Minimum is 1 millisecond
     */
    public function equals(TimestampInterface $timestamp, float $accuracy = 1): bool;

    /**
     * @return float timestamp in seconds since the Unix epoch with floating milliseconds
     */
    public function getUnix(): float;

    public function toNativeDateTime(): DateTimeImmutable;
}
