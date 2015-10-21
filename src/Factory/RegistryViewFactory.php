<?php

/*
 * This file is part of the shopery\view package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopery\View\Factory;

use Assert\Assertion;

use Shopery\View\Exception\UnsupportedObjectException;
use Shopery\View\View;

/**
 * Class RegistryViewFactory
 *
 * @author Berny Cantos <be@rny.cc>
 */
class RegistryViewFactory implements ViewFactory
{
    /**
     * @var ViewFactory[]
     */
    private $registry = [];

    /**
     * Register a factory in the abstract factory
     *
     * @param string $className
     *
     * @param ViewFactory $viewFactory
     */
    public function registerFactory($className, ViewFactory $viewFactory)
    {
        Assertion::string($className);

        $this->registry[$className] = $viewFactory;
    }

    /**
     * Create a view for the object
     *
     * @param $object
     *
     * @return View
     */
    public function createView($object)
    {
        Assertion::true(is_object($object), sprintf(
            'Parameter must be an object, %s found',
            gettype($object)
        ));

        foreach ($this->registry as $className => $viewFactory) {

            if ($object instanceof $className) {
                return $viewFactory->createView($object);
            }
        }

        throw new UnsupportedObjectException(sprintf(
            'Can\'t create a View from object of class "%s"',
            get_class($object)
        ));
    }
}
