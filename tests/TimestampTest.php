<?php

declare(strict_types=1);

namespace BladL\Time;

use PHPUnit\Framework\TestCase;

final class TimestampTest extends TestCase
{
    public function testOperations(): void
    {
        $now = Timestamp::now();
        $later = $now->add(TimeInterval::minute(30));
        $earlier = $now->sub(TimeInterval::second());
        self::assertTrue($later->laterThan($earlier));
        self::assertTrue($earlier->earlierThan($later));
        self::assertTrue($earlier->earlierThan($now));
        self::assertTrue($later->laterThan($now));
        self::assertTrue($earlier->isBetween($earlier->sub(TimeInterval::second()), $now));
        self::assertTrue($now->isBetween($later, $earlier));
        self::assertTrue($earlier->add(TimeInterval::day())->laterThan($later));
        self::assertTrue($now->equals($now));
    }

    public function testAccuracy(): void
    {
        $now = Timestamp::now();
        $millisecondLater = $now->add(TimeInterval::millisecond());
        $restoredNow = $millisecondLater->sub(TimeInterval::millisecond());
        self::assertTrue($now->equals($now, accuracy: 0.000000001));
        self::assertTrue($millisecondLater->equals($now));
        self::assertTrue($millisecondLater->equals($now, 0.0001));
        self::assertTrue($millisecondLater->equals($now, 0.00001), 'Precision should not work correctly for less than milliseconds');
        self::assertFalse($millisecondLater->equals($now, 0.00000001));

        self::assertTrue($restoredNow->equals($now));
        self::assertTrue($restoredNow->equals($now, 0.0001));
        self::assertTrue($restoredNow->equals($now, 0.00000001));
    }
}
