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
 * Class ObjectViewFactory
 *
 * @author Berny Cantos <be@rny.cc>
 */
class ObjectViewFactory implements ViewFactory
{
    private $viewName;

    /**
     * @param string $viewName
     */
    public function __construct($viewName)
    {
        $this->viewName = $viewName;
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
        $viewName = $this->viewName;

        return new $viewName($object);
    }
}
