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

use Shopery\View\Property\CachedProperty;
use Shopery\View\Property\Property;

/**
 * Class CachedPropertyTest
 *
 * @author Berny Cantos <be@rny.cc>
 */
class CachedPropertyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Underlying property is called at most once
     */
    public function test_calls_at_most_once()
    {
        $innerProperty = $this->prophesize(Property::class);
        $innerProperty->get()
            ->willReturn(10)
            ->shouldBeCalledTimes(1);

        $property = new CachedProperty($innerProperty->reveal());

        $this->assertEquals(10, $property->get());
        $this->assertEquals(10, $property->get());
    }

    /**
     * Underlying property is not called if no `get`
     */
    public function test_does_not_call_if_not_get()
    {
        $innerProperty = $this->prophesize(Property::class);
        $innerProperty->get()
            ->shouldNotBeCalled();

        $property = new CachedProperty($innerProperty->reveal());

        $this->assertNotNull($property);
    }
}
