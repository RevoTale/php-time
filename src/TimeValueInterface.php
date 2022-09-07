<?php

declare(strict_types=1);

namespace BladL\Time;

interface TimeValueInterface
{
    /**
     * @return float value in seconds
     *
     * @internal
     */
    public function _getInternalTimeValue(): float;
}
