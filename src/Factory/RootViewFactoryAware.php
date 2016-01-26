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

/**
 * Interface RootViewFactoryAware
 *
 * @author Berny Cantos <be@rny.cc>
 */
interface RootViewFactoryAware
{
    /**
     * Called before a view is returned from `RootViewFactory`
     *
     * @param RootViewFactory $rootFactory
     */
    public function setRootViewFactory(RootViewFactory $rootFactory);
}
