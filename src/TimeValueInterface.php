<?php

declare(strict_types=1);

namespace BladL\Time;

interface TimeValueInterface
{
    /**
     * @return float value in seconds for Interfalc =, Timstamps etc
     *
     * @internal
     */
    public function getTimeValue(): float;
}
