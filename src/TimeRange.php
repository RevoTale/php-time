<?php
declare(strict_types=1);

namespace BladL\Time;

/**
 *
 */
final class TimeRange
{
    public function __construct(public readonly Moment $start, public readonly Moment $finish)
    {
    }
}
