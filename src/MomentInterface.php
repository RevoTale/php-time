<?php

declare(strict_types=1);

namespace BladL\Time;

use DateTimeImmutable;

/**
 * Casic methods of moment.
 */
interface MomentInterface
{
    public function laterThan(MomentInterface $moment): bool;

    public function earlierThan(MomentInterface $moment): bool;

    public function add(TimeInterval $interval): MomentInterface;

    public function sub(TimeInterval $interval): MomentInterface;

    public function getTimestamp(): int;

    /**
     * @internal
     */
    public function getFloatingSeconds(): float;

    public function toNativeDateTime(): DateTimeImmutable;
}
