<?php

declare(strict_types=1);

namespace Limepie\TwitterOAuth\Tests;

use Limepie\TwitterOAuth\Consumer;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class ConsumerTest extends TestCase
{
    public function testToString()
    {
        $key      = \uniqid();
        $secret   = \uniqid();
        $consumer = new Consumer($key, $secret);

        $this->assertEquals(
            "Consumer[key={$key},secret={$secret}]",
            $consumer->__toString(),
        );
    }
}
