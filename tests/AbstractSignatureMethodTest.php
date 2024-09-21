<?php

declare(strict_types=1);

namespace Limepie\TwitterOAuth\Tests;

use Limepie\TwitterOAuth\Consumer;
use Limepie\TwitterOAuth\Request;
use Limepie\TwitterOAuth\Token;
use PHPUnit\Framework\TestCase;

abstract class AbstractSignatureMethodTest extends TestCase
{
    protected $name;

    /**
     * @return SignatureMethod
     */
    abstract public function getClass();

    abstract protected function signatureDataProvider();

    public function testGetName()
    {
        $this->assertEquals($this->name, $this->getClass()->getName());
    }

    /**
     * @dataProvider signatureDataProvider
     *
     * @param mixed $expected
     * @param mixed $request
     * @param mixed $consumer
     * @param mixed $token
     */
    public function testBuildSignature($expected, $request, $consumer, $token)
    {
        $this->assertEquals(
            $expected,
            $this->getClass()->buildSignature($request, $consumer, $token),
        );
    }

    protected function getRequest()
    {
        return $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;
    }

    protected function getConsumer(
        $key = null,
        $secret = null,
        $callbackUrl = null,
    ) {
        return $this->getMockBuilder(Consumer::class)
            ->setConstructorArgs([$key, $secret, $callbackUrl])
            ->getMock()
        ;
    }

    protected function getToken($key = null, $secret = null)
    {
        return $this->getMockBuilder(Token::class)
            ->setConstructorArgs([$key, $secret])
            ->getMock()
        ;
    }
}
