<?php

declare(strict_types=1);

namespace BladL\Time;

/**
 * Day of week.
 */
enum DayOfWeek
{
    case Monday;
    case Tuesday;
    case Wednesday;
    case Thursday;
    case Friday;
    case Saturday;
    case Sunday;
    /**
     * @psalm-pure
     */
    public static function fromISO(int $day): self
    {
        return match ($day) {
            1 => self::Monday,
            2 => self::Tuesday,
            3 => self::Wednesday,
            4 => self::Thursday,
            5 => self::Friday,
            6 => self::Saturday,
            7 => self::Sunday
        };
    }

    public function isMonday(): bool
    {
        return self::Monday === $this;
    }

    public function isTuesday(): bool
    {
        return self::Tuesday === $this;
    }

    public function isWednesday(): bool
    {
        return self::Wednesday === $this;
    }

    public function isThursday(): bool
    {
        return self::Thursday === $this;
    }

    public function isFriday(): bool
    {
        return self::Friday === $this;
    }

    public function isSaturday(): bool
    {
        return self::Saturday === $this;
    }

    public function isSunday(): bool
    {
        return self::Sunday === $this;
    }
}
