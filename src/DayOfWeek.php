<?php

declare(strict_types=1);

namespace BladL\Time;

use function in_array;

/**
 * Class DayOfWeek.
 *
 * @psalm-immutable
 */
class DayOfWeek
{
    public const ISO_MONDAY = 1;
    public const ISO_TUESDAY = 2;
    public const ISO_WEDNESDAY = 3;
    public const ISO_THURSDAY = 4;
    public const ISO_FRIDAY = 5;
    public const ISO_SATURDAY = 6;
    public const ISO_SUNDAY = 7;
    private int $dayISO;

    private function __construct(int $dayISO)
    {
        $this->dayISO = $dayISO;
    }

    /**
     * @psalm-mutation-free
     */
    public static function fromISO(int $day): self
    {
        return new self($day);
    }

    public function inISO(int ...$days): bool
    {
        return in_array($this->dayISO, $days, true);
    }

    public function isMonday(): bool
    {
        return $this->inISO(self::ISO_MONDAY);
    }

    public function isTuesday(): bool
    {
        return $this->inISO(self::ISO_TUESDAY);
    }

    public function isWednesday(): bool
    {
        return $this->inISO(self::ISO_WEDNESDAY);
    }

    public function isThursday(): bool
    {
        return $this->inISO(self::ISO_THURSDAY);
    }

    public function isFriday(): bool
    {
        return $this->inISO(self::ISO_FRIDAY);
    }

    public function isSaturday(): bool
    {
        return $this->inISO(self::ISO_SATURDAY);
    }

    public function isSunday(): bool
    {
        return $this->inISO(self::ISO_SUNDAY);
    }
}
