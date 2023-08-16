<?php

declare(strict_types=1);

namespace Grisaia\Time;

/**
 * Period of time for common purposes.
 */
final class PeriodOfTime
{
    public function __construct(public readonly Timestamp $from, public readonly Timestamp $to)
    {
    }
}
