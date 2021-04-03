<?php

declare(strict_types=1);
namespace BladL\Time;
/**
 * Class DayOfWeek.
 */
final class DayOfWeek
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

    public static function fromISO(int $day): self
    {
        return new self($day);
    }

    public function inISO(int ...$days): bool
    {
        return in_array($this->dayISO, $days, true);
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
        return $this->inISO($this->dayISO);
    }

    public function isSaturday(): bool
    {
        return $this->inISO($this->dayISO);
    }

    public function isSunday(): bool
    {
        return $this->inISO($this->dayISO);
    }
}
