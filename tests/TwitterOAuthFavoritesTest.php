<?php

/**
 * WARNING: Running tests will post and delete through the actual Twitter account when updating or saving VCR cassettes.
 */

declare(strict_types=1);

namespace Limepie\TwitterOAuth\Test;

use Limepie\TwitterOAuth\TwitterOAuth;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class TwitterOAuthFavoritesTest extends TestCase
{
    /** @var TwitterOAuth */
    protected $twitter;

    protected function setUp() : void
    {
        $this->twitter = new TwitterOAuth(
            CONSUMER_KEY,
            CONSUMER_SECRET,
            ACCESS_TOKEN,
            ACCESS_TOKEN_SECRET,
        );
        $this->twitter->setApiVersion('1.1');
        $this->userId = \explode('-', ACCESS_TOKEN)[0];
    }

    /**
     * @vcr testPostFavoritesCreate.json
     */
    public function testPostFavoritesCreate()
    {
        $result = $this->twitter->post('favorites/create', [
            'id' => '6242973112',
        ]);
        $this->assertEquals(200, $this->twitter->getLastHttpCode());
    }

    /**
     * @depends testPostFavoritesCreate
     *
     * @vcr testPostFavoritesDestroy.json
     */
    public function testPostFavoritesDestroy()
    {
        $this->twitter->post('favorites/destroy', ['id' => '6242973112']);
        $this->assertEquals(200, $this->twitter->getLastHttpCode());
    }
}
