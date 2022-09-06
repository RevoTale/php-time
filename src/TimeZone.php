<?php

declare(strict_types=1);

namespace BladL\Time;

use DateTimeZone;

/**
 * Timezone enumeration.
 */
enum TimeZone: string
{
    case EuropeKyiv = 'Europe/Kyiv';
    case UTC = 'UTC';
    public function toNativeDateTimeZone(): DateTimeZone
    {
        return new DateTimeZone($this->value);
    }

    public function now(): TimeZoneMoment
    {
        return $this->getTimeZoned(Moment::now());
    }

    /**
     * @param int $unix in seconds
     */
    public function fromUnix(int $unix): TimeZoneMoment
    {
        return $this->getTimeZoned(Moment::fromUnix($unix));
    }

    public function getTimeZoned(Moment $time): TimeZoneMoment
    {
        return new TimeZoneMoment(timeZone: $this, moment: $time);
    }
}
