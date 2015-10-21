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

use Shopery\View\Dynamic\DynamicView;
use Shopery\View\View;

/**
 * Class RecursiveViewFactory
 *
 * @author Berny Cantos <be@rny.cc>
 */
class RecursiveViewFactory extends DecoratedViewFactory
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
        if (!is_array($object)) {
            return parent::createView($object);
        }

        foreach ($object as $key => $value) {
            if (is_object($value) || is_array($value)) {
                $object[$key] = $this->createView($value);
            }
        }

        return new DynamicView($object);
    }
}
