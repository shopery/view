<?php

/*
 * This file is part of the shopery\view package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopery\View\Test\Property;

use Shopery\View\Property\LazyProperty;

/**
 * Class LazyPropertyTest
 *
 * @author Berny Cantos <be@rny.cc>
 */
class LazyPropertyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Lazy function is called on `get`
     */
    public function test_calls_on_property_get()
    {
        $function = function () {
            return 10;
        };

        $property = new LazyProperty($function);

        $this->assertEquals(10, $property->get());
    }

    /**
     * Lazy function is not called if no `get`
     */
    public function test_does_not_call_if_not_get()
    {
        $function = function () {
            throw new \Exception('Must not be called');
        };

        $property = new LazyProperty($function);

        $this->assertNotNull($property);
    }

    /**
     * Lazy function is called each time you `get`
     */
    public function test_calls_once_for_each_get()
    {
        $count = 0;
        $function = function () use (&$count) {
            return $count++;
        };

        $property = new LazyProperty($function);

        $this->assertEquals(0, $property->get());
        $this->assertEquals(1, $property->get());
    }

    /**
     * Can create `LazyProperty` from any callable
     *
     * @dataProvider provider_create_with_any_callable
     *
     * @param $callable
     * @param $expected
     */
    public function test_create_from_any_callable($callable, $expected)
    {
        $property = new LazyProperty($callable);

        $this->assertEquals($expected, $property->get());

    }

    /**
     * Provide valid callbacks and expected result
     *
     * @return array
     */
    public function provider_create_with_any_callable()
    {
        return [
            'lambda' => [
                function () { return 1; }, 1
            ],

            'method in object' => [
                [ $this, 'methodCallback' ], 10
            ],

            'static method' => [
                [ self::class, 'staticCallback' ], 100
            ],

            '__invoke method in object' => [
                $this, 1000
            ],

            'function' => [
                __NAMESPACE__ . '\\lazyPropertyFunctionCallback', 10000
            ],
        ];
    }

    /**
     * Used to test method callbacks
     *
     * @return int
     */
    public function methodCallback()
    {
        return 10;
    }

    /**
     * Used to test static method callbacks
     *
     * @return int
     */
    static public function staticCallback()
    {
        return 100;
    }

    /**
     * Used to test objects using __invoke magic method
     *
     * @return int
     */
    public function __invoke()
    {
        return 1000;
    }
}

/**
 * Used to test function callbacks
 *
 * @return int
 */
function lazyPropertyFunctionCallback()
{
    return 10000;
}
