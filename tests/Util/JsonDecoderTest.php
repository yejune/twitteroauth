<?php

namespace Limepie\TwitterOAuth\Tests;

use Limepie\TwitterOAuth\Util\JsonDecoder;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class JsonDecoderTest extends TestCase
{
    /**
     * @dataProvider jsonProvider
     *
     * @param mixed $input
     * @param mixed $asArray
     * @param mixed $expected
     */
    public function testDecode($input, $asArray, $expected)
    {
        $this->assertEquals($expected, JsonDecoder::decode($input, $asArray));
    }

    public function jsonProvider()
    {
        return [
            ['[]', true, []],
            ['[1,2,3]', true, [1, 2, 3]],
            [
                '[{"id": 556179961825226750}]',
                true,
                [['id' => 556_179_961_825_226_750]],
            ],
            ['[]', false, []],
            ['[1,2,3]', false, [1, 2, 3]],
            [
                '[{"id": 556179961825226750}]',
                false,
                [
                    $this->getClass(function ($object) {
                        $object->id = 556_179_961_825_226_750;

                        return $object;
                    }),
                ],
            ],
        ];
    }

    /**
     * @param callable $callable
     *
     * @return stdClass
     */
    private function getClass(\Closure $callable)
    {
        $object = new \stdClass();

        return $callable($object);
    }
}
