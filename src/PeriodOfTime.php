<?php

declare(strict_types=1);

namespace BladL\Time;

/**
 * Period of time for common purposes.
 */
final class PeriodOfTime
{
    public function __construct(public readonly Moment $from, public readonly Moment $to)
    {
    }
}
