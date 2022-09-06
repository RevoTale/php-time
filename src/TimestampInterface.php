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

    /**
     * @return int timestamp in seconds since the Unix epoch
     */
    public function getTimestamp(): int;

    /**
     * @internal
     */
    public function getFloatingSeconds(): float;

    public function toNativeDateTime(): DateTimeImmutable;
}
