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

/**
 * Interface ViewExtensionResolver.
 *
 * Return view extensions for a view
 *
 * @author Berny Cantos <be@rny.cc>
 */
interface ViewExtensionResolver
{
    /**
     * Returns extensions which can be applied to a view.
     *
     * @param object $object
     *
     * @return ViewExtension[]
     */
    public function resolveExtensions($object);
}
