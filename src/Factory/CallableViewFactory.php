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
 * Class CallableViewFactory
 *
 * @author Berny Cantos <be@rny.cc>
 */
class CallableViewFactory implements ViewFactory
{
    /**
     * Will be called on view creation
     *
     * @var callable
     */
    private $callable;

    /**
     * Constructor
     *
     * @param $callable
     */
    public function __construct($callable)
    {
        $this->callable = $callable;
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
        return call_user_func($this->callable, $object, $this);
    }
}
