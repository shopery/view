<?php

/*
 * This file is part of the shopery\view package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopery\View\Test\Factory;
use Assert\Assertion;
use Prophecy\Argument;
use Shopery\View\Dynamic\DynamicView;
use Shopery\View\Factory\RegistryViewFactory;
use Shopery\View\Factory\RecursiveViewFactory;
use Shopery\View\Factory\ViewFactory;
use Shopery\View\Property\LazyProperty;
use Shopery\View\View;

/**
 * Class ViewFactoryTest
 *
 * @author Berny Cantos <be@rny.cc>
 */
class ViewFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function test_()
    {
        $registryFactory = new RegistryViewFactory();

        $factory = $this->prophesize(ViewFactory::class);
        $factory->createView(Argument::any())
            ->will(function ($args) {
                return new DynamicView([
                    'data' => new LazyProperty([$args[0], 'getData']),
                ]);
            });
        $registryFactory->registerFactory(SomeMoreElement::class, $factory->reveal());

        $factory = $this->prophesize(ViewFactory::class);
        $factory->createView(Argument::any())
            ->will(function ($args) {
                return new DynamicView([
                    'data' => new LazyProperty([$args[0], 'getElementData']),
                ]);
            });
        $registryFactory->registerFactory(ElementInterface::class, $factory->reveal());

        $registryFactory->registerFactory(NotElement::class, new NotElementViewFactory());

        $factory = new RecursiveViewFactory($registryFactory);

        $view = $factory->createView([
            'name' => 'David Hasselhoff',
            'element' => new Element(),
            'other' => new OtherElement(),
            'someMore' => new SomeMoreElement(),
            'notElement' => new NotElement(),
        ]);

        $this->assertEquals('data#element', $view->element->data);
        $this->assertEquals('data#other', $view->other->data);
        $this->assertEquals('data#some_more', $view->someMore->data);
        $this->assertEquals('data#not_element', $view->notElement->data);
    }
}

interface ElementInterface
{
    public function getElementData();
}

class Element implements ElementInterface
{
    public function getElementData()
    {
        return 'data#element';
    }
}

class OtherElement implements ElementInterface
{
    public function getElementData()
    {
        return 'data#other';
    }
}

class SomeMoreElement implements ElementInterface
{
    public function getData()
    {
        return 'data#some_more';
    }

    public function getElementData()
    {
        return 'nop';
    }
}

class NotElement
{
    public function getMyData()
    {
        return 'data#not_element';
    }
}

class NotElementViewFactory implements ViewFactory
{
    /**
     * Create a view for the object
     *
     * @param $object
     *
     * @return View
     */
    public function createView($object)
    {
        Assertion::isInstanceOf($object, NotElement::class);

        return new DynamicView([
            'data' => new LazyProperty([$object, 'getMyData']),
        ]);
    }
}
