<?php

/*
 * This file is part of the shopery\view package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopery\View\Test\Dynamic;

use Shopery\View\ChainedView;
use Shopery\View\Dynamic\DynamicView;
use Shopery\View\ObjectView;
use Shopery\View\Property\Property;

/**
 * Class DynamicViewTest
 *
 * @author Berny Cantos <be@rny.cc>
 */
class DynamicViewTest extends \PHPUnit_Framework_TestCase
{
    /**
     * DynamicView allows to define scalar properties
     */
    public function test_can_define_a_scalar_property()
    {
        $name = 'David Hasselhoff';
        $view = new DynamicView([
            'name' => $name,
        ]);

        $this->assertEquals($name, $view->name);
    }

    /**
     * DynamicView allows to define properties with custom behaviour
     */
    public function test_can_define_a_property()
    {
        $name = 'Rick Astley';
        $property = $this->prophesize(Property::class);
        $property->get()
            ->willReturn($name)
            ->shouldBeCalled();

        $view = new DynamicView([
            'name' => $property->reveal(),
        ]);

        $this->assertEquals($name, $view->name);
    }

    /**
     * DynamicView allows to define properties with custom behaviour
     *
     * @expectedException \Shopery\View\Exception\UndefinedPropertyException
     */
    public function test_throws_if_property_not_found()
    {
        $view = new DynamicView([]);

        $view->name;
    }

    public function test_object_view()
    {
        $object1 = new TestableObject('David');
        $object2 = new TestableObject('Hasselhoff');

        $view = new ChainedView([

            new ObjectView($object1, [
                'name' => 'getName',
                'empty' => 'isEmptyNamed',
            ]),

            new ObjectView($object2, [
                'surname' => 'getName',
            ]),
        ]);

        $this->assertEquals('David', $view->name);
        $this->assertEquals(false, $view->empty);
        $this->assertEquals('Hasselhoff', $view->surname);
    }
}

class TestableObject
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function isEmptyNamed()
    {
        return strlen($this->name) === 0;
    }
}
