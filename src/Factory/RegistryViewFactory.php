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
     * Constructor
     *
     * @param ViewFactory[] $factories
     */
    public function __construct($factories = [])
    {
        foreach ($factories as $className => $factory) {
            $this->registerFactory($className, $factory);
        }
    }

    /**
     * Register a factory in the abstract factory
     *
     * @param string $className
     *
     * @param ViewFactory $viewFactory
     */
    public function registerFactory($className, ViewFactory $viewFactory)
    {
        $this->registry[$className] = $viewFactory;
    }

    /**
     * Create a view for the object, looking for a suitable factory
     *
     * @param $object
     *
     * @return View
     */
    public function createView($object)
    {
        if (!is_object($object)) {
            return null;
        }

        foreach ($this->registry as $className => $viewFactory) {

            if ($object instanceof $className) {
                return $viewFactory->createView($object);
            }
        }
    }
}
