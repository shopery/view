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
 * Class DecoratedProperty
 *
 * Decorates another property
 *
 * @author Berny Cantos <be@rny.cc>
 */
abstract class DecoratedProperty implements Property
{
    /**
     * Inner property
     *
     * @var mixed
     */
    private $property;

    /**
     * Constructor
     *
     * @param Property $property
     */
    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    /**
     * Get current property value
     *
     * Extend by calling parent::get()
     *
     * @return mixed
     */
    public function get()
    {
        return $this->property->get();
    }
}
