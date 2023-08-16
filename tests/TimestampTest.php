<?php

declare(strict_types=1);

namespace Grisaia\Time;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

final class TimestampTest extends TestCase
{
    private const TEST_TIME_ZONE = TimeZone::EuropeKyiv;

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
        self::assertSame($now->withTimeZone(self::TEST_TIME_ZONE)->setTime(6, 20)->sub(TimeInterval::hour(5))->getUnix(), $now->withTimeZone(self::TEST_TIME_ZONE)->setTime(1, 20)->getUnix());
    }

    /**
     * @throws \Exception
     */
    public function testNative(): void
    {
        $now = Timestamp::now();
        self::assertSame($now->toNativeDateTime()->getTimestamp(), $now->getUnixSeconds());
        $format = 'Y-m-d H:i:s';
        $nativeNowTimeZoned = $now->toNativeDateTime()->setTimezone(self::TEST_TIME_ZONE->toNativeDateTimeZone());
        $nowTimeZoned = $now->withTimeZone(self::TEST_TIME_ZONE);
        self::assertSame($nativeNowTimeZoned->getTimestamp(), $nowTimeZoned->getUnixSeconds());
        self::assertSame($nativeNowTimeZoned->getTimezone()->getName(), $nowTimeZoned->getTimeZone()->toNativeDateTimeZone()->getName());
        self::assertSame($nativeNowTimeZoned->getTimezone()->getName(), $nowTimeZoned->toNativeDateTime()->getTimezone()->getName());

        self::assertSame($nativeNowTimeZoned->format($format), $nowTimeZoned->format($format));
        self::assertSame($nativeNowTimeZoned->setTime(3, 2, 4)->format($format), $nowTimeZoned->setTime(3, 2, 4)->format($format));

        self::assertNotSame($nativeNowTimeZoned->setTime(3, 1, 4)->format($format), $nowTimeZoned->setTime(3, 2, 4)->format($format));
        self::assertSame($nativeNowTimeZoned->getTimestamp(), $nowTimeZoned->getUnixSeconds());
    }

    /**
     * @throws \Exception
     */
    public function testTimeZones(): void
    {
        $target = 10000000;
        $format = 'Y-m-d H:i:s';
        $native = (new DateTimeImmutable("@$target"))->setTimezone(new \DateTimeZone('Europe/Kiev'));
        $lib = self::TEST_TIME_ZONE->fromUnix($target);
        self::assertSame($native->getTimestamp(), $lib->toNativeDateTime()->getTimestamp());
        self::assertSame($native->getTimezone()->getName(), $lib->toNativeDateTime()->getTimezone()->getName());

        self::assertSame($native->format($format), $lib->format($format));
    }
}
