<?php

/*
 * This file is part of the shopery\view package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopery\View;
use Traversable;

/**
 * Class IterableView
 *
 * @author Berny Cantos <be@rny.cc>
 */
class IterableView implements View, \IteratorAggregate
{
    /**
     * Retrieve an external iterator
     *
     * @return Traversable
     */
    public function getIterator()
    {
    }
}
