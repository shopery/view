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

use Traversable;

use Shopery\View\View;
use Shopery\View\View\CollectionView;

/**
 * Class CollectionViewFactory
 *
 * @author Berny Cantos <be@rny.cc>
 */
class CollectionViewFactory implements ViewFactory
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
        if (!($object instanceof Traversable)) {
            return null;
        }

        return new CollectionView($object);
    }
}
