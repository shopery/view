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

use Shopery\View\Exception\InvalidArgumentException;
use Shopery\View\View;

/**
 * Class CompositeViewFactory
 *
 * @author Berny Cantos <be@rny.cc>
 */
class CompositeViewFactory implements ViewFactory
{
    /**
     * @var ViewFactory[]
     */
    private $factories = [];

    /**
     * @param array|\Traversable $factories
     */
    public function __construct($factories)
    {
        foreach ($factories as $factory) {
            if (!($factory instanceof ViewFactory)) {
                throw new InvalidArgumentException(
                    '"CompositeViewFactory" expects "ViewFactory" parameters'
                );
            }
        }

        $this->factories = $factories;
    }

    /**
     * Create a view for the object, delegating to inner factories
     *
     * @param $object
     *
     * @return View
     */
    public function createView($object)
    {
        foreach ($this->factories as $factory) {
            $view = $factory->createView($object);

            if (null !== $view) {
                return $view;
            }
        }
    }
}
