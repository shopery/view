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

use Shopery\View\Factory\RootViewFactory;
use Shopery\View\Factory\RootViewFactoryAware;
use Shopery\View\View;

/**
 * Class AbstractObjectView
 *
 * @author Berny Cantos <be@rny.cc>
 */
abstract class AbstractObjectView implements View, RootViewFactoryAware
{
    /**
     * @var RootViewFactory
     */
    private $rootFactory;

    /**
     * @var mixed
     */
    protected $object;

    /**
     * @param mixed $object
     */
    protected function __construct($object)
    {
        $this->object = $object;
    }

    /**
     * Create a view for an object
     *
     * @param $object
     *
     * @return View
     */
    protected function createViewFor($object)
    {
        return $this->rootFactory->createView($object);
    }

    /**
     * Called before a view is returned from `RootViewFactory`
     *
     * @param RootViewFactory $rootFactory
     */
    public function setRootViewFactory(RootViewFactory $rootFactory)
    {
        $this->rootFactory = $rootFactory;
    }
}
