<?php

/*
 * This file is part of the shopery\view package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopery\View\Extension;

use Shopery\View\Factory\ViewFactory;
use Shopery\View\View;

/**
 * Class ExtensibleViewFactory.
 *
 * Middleware to allow view extensions.
 *
 * @author Berny Cantos <be@rny.cc>
 */
class ExtensibleViewFactory implements ViewFactory
{
    /**
     * Decorated view factory.
     *
     * @var ViewFactory
     */
    private $viewFactory;

    /**
     * Extension resolver.
     */
    private $resolver;

    /**
     * @param ViewFactory $viewFactory
     * @param ViewExtensionResolver $resolver
     */
    public function __construct(ViewFactory $viewFactory, ViewExtensionResolver $resolver)
    {
        $this->viewFactory = $viewFactory;
        $this->resolver = $resolver;
    }

    /**
     * Create a view for the object.
     *
     * @param $object
     *
     * @return View
     */
    public function createView($object)
    {
        $view = $this->viewFactory->createView($object);

        if ($view instanceof View) {
            $this->extend($view, $object);
        }

        return $view;
    }

    private function extend(View $view, $object)
    {
        foreach ($this->resolver->resolveExtensions($object) as $extension) {
            $extension->extend($view, $object);
        }
    }
}
