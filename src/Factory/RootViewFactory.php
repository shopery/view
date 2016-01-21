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
use Shopery\View\Exception;

/**
 * Class RootViewFactory
 *
 * Serves as a root for factories
 *
 * @author Berny Cantos <be@rny.cc>
 */
class RootViewFactory implements ViewFactory
{
    const NOT_FOUND_THROWS_EXCEPTION = 1;
    const NOT_FOUND_RETURNS_NULL = 2;
    const NOT_FOUND_RETURN_SOURCE = 3;

    /**
     * @var ViewFactory
     */
    private $factory;

    /**
     * @var int
     */
    private $notFoundBehaviour;

    /**
     * @param int $notFoundBehaviour What behaviour when a suitable view factory can't be found
     */
    public function __construct($notFoundBehaviour = self::NOT_FOUND_THROWS_EXCEPTION)
    {
        $this->notFoundBehaviour = $notFoundBehaviour;
    }

    /**
     * @param ViewFactory $factory
     *
     * @return self
     */
    public function setFactory(ViewFactory $factory)
    {
        $this->factory = $factory;

        return $this;
    }

    /**
     * Create a view for the object, allows arrays recursively
     *
     * @param $object
     *
     * @return View
     *
     * @throws Exception\UnsupportedObjectException
     */
    public function createView($object)
    {
        if (is_array($object)) {
            return array_map([ $this, 'createView' ], $object);
        }

        $view = $this->factory->createView($object);

        if (false === $view instanceof View) {
            return $this->notSuitableFactoryFor($object);
        }

        if ($view instanceof RootViewFactoryAware) {
            $view->setRootViewFactory($this);
        }

        return $view;
    }

    /**
     * Behaviour when a suitable view factory can't be found
     *
     * @param mixed $object
     *
     * @return null
     */
    private function notSuitableFactoryFor($object)
    {
        switch ($this->notFoundBehaviour) {
            case self::NOT_FOUND_RETURNS_NULL:
                return null;

            case self::NOT_FOUND_RETURN_SOURCE:
                return $object;

            case self::NOT_FOUND_THROWS_EXCEPTION:
            default:
                throw new Exception\UnsupportedObjectException(sprintf(
                    'Can\'t create a View from object of type "%s"',
                    is_object($object) ? get_class($object) : gettype($object)
                ));
        }
    }
}
