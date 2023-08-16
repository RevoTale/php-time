<?php

declare(strict_types=1);

namespace Grisaia\Time;

use DateTimeImmutable;

/**
 * Basic methods of moment.
 */
interface TimestampInterface extends TimeValueInterface
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
     * @return float most accurate timestamp in seconds
     */
    public function getUnix(): float;

    public function toNativeDateTime(): DateTimeImmutable;
}
