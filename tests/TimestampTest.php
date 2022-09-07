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
    }
}
