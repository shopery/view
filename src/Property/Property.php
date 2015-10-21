<?php

/*
 * This file is part of the shopery\view package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopery\View\Property;

/**
 * Interface Property
 *
 * Value holder
 *
 * @author Berny Cantos <be@rny.cc>
 */
interface Property
{
    /**
     * Get current property value
     *
     * @return mixed
     */
    public function get();
}
