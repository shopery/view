<?php

/*
 * This file is part of the shopery\view package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopery\View\Dynamic;

use Shopery\View\Property\CachedProperty;
use Shopery\View\Property\LazyProperty;
use Shopery\View\Property\Property;

/**
 * Class DynamicViewBuilder
 *
 * @author Berny Cantos <be@rny.cc>
 */
class DynamicViewBuilder
{
    /**
     * Properties
     *
     * @var array
     */
    private $properties = array();

    /**
     * Add property
     *
     * @param string $field
     * @param mixed  $property
     *
     * @return $this
     */
    public function add($field, $property)
    {
        $this->properties[$field] = $property;

        return $this;
    }

    /**
     * Generate view with current properties
     *
     * @return DynamicView
     */
    public function build()
    {
        return new DynamicView($this->properties);
    }

    /**
     * Creates a lazy property
     *
     * @param callable $callback
     *
     * @return LazyProperty
     */
    public function lazy($callback)
    {
        return new LazyProperty($callback);
    }

    /**
     * Creates a cached property
     *
     * @param Property $property
     *
     * @return CachedProperty
     */
    public function cached(Property $property)
    {
        return new CachedProperty($property);
    }
}
