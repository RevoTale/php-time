<?php

declare(strict_types=1);

namespace Grisaia\Time;

use DateTimeZone;

/**
 * Timezone enumeration.
 */
enum TimeZone: string
{
    case EuropeKyiv = 'Europe/Kiev';
    case UTC = 'UTC';

    public function toNativeDateTimeZone(): DateTimeZone
    {
        return new DateTimeZone($this->value);
    }

    public function now(): LocalTimestamp
    {
        return $this->getTimeZoned(Timestamp::now());
    }

    /**
     * @param int $unix in seconds
     */
    public function fromUnix(int $unix): LocalTimestamp
    {
        return $this->getTimeZoned(Timestamp::fromUnix($unix));
    }

    public function getTimeZoned(Timestamp $time): LocalTimestamp
    {
        return new LocalTimestamp(timeZone: $this, timestamp: $time);
    }
}
