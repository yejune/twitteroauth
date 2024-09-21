<?php

declare(strict_types=1);

namespace Limepie\TwitterOAuth\Tests;

use Limepie\TwitterOAuth\Token;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class TokenTest extends TestCase
{
    /**
     * @dataProvider tokenProvider
     *
     * @param mixed $expected
     * @param mixed $key
     * @param mixed $secret
     */
    public function testToString($expected, $key, $secret)
    {
        $token = new Token($key, $secret);

        $this->assertEquals($expected, $token->__toString());
    }

    public function tokenProvider()
    {
        return [
            ['oauth_token=key&oauth_token_secret=secret', 'key', 'secret'],
            [
                'oauth_token=key%2Bkey&oauth_token_secret=secret',
                'key+key',
                'secret',
            ],
            [
                'oauth_token=key~key&oauth_token_secret=secret',
                'key~key',
                'secret',
            ],
        ];
    }
}
