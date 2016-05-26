<?php

/*
 * This file is part of the shopery\view package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopery\View\View;

use IteratorIterator;

use Shopery\View\Factory\RootViewFactoryAware;
use Shopery\View\Factory\RootViewFactory;
use Shopery\View\View;

/**
 * Class CollectionView
 *
 * @author Berny Cantos <be@rny.cc>
 */
class CollectionView extends IteratorIterator implements View, RootViewFactoryAware, \Countable
{
    /**
     * @var RootViewFactory
     */
    private $rootFactory;

    /**
     * @param RootViewFactory $rootFactory
     */
    public function setRootViewFactory(RootViewFactory $rootFactory)
    {
        $this->rootFactory = $rootFactory;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->rootFactory->createView(parent::current());
    }

    public function count()
    {
        return iterator_count($this);
    }
}
