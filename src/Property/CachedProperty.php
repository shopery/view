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
 * Class CachedProperty
 *
 * Holds a property which is cached
 *
 * @author Berny Cantos <be@rny.cc>
 */
class CachedProperty extends DecoratedProperty
{
    /**
     * Cached value
     *
     * @var mixed
     */
    private $cachedValue;

    /**
     * Constructor
     *
     * @param Property $property
     */
    public function __construct(Property $property)
    {
        parent::__construct($property);
        // To allow `null` values, `this` is used as a special "empty" value
        $this->cachedValue = $this;
    }

    /**
     * Get current property value
     *
     * @return mixed
     */
    public function get()
    {
        if ($this->cachedValue === $this) {
            $this->cachedValue = parent::get();
        }

        return $this->cachedValue;
    }
}
