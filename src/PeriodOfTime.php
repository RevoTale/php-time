<?php

declare(strict_types=1);

namespace Grisaia\Time;

/**
 * Period of time for common purposes.
 */
final readonly class PeriodOfTime
{
    public function __construct(public Timestamp $start, public Timestamp $end)
    {
    }
}
