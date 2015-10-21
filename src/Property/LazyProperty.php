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

use Assert\Assertion;

/**
 * Class LazyProperty
 *
 * Holds a value which is lazy evaluated through a callable
 *
 * @author Berny Cantos <be@rny.cc>
 */
class LazyProperty implements Property
{
    /**
     * Call to get the result of the property
     *
     * @var mixed
     */
    private $callback;

    /**
     * Constructor
     *
     * @param mixed $callback
     */
    public function __construct($callback)
    {
        Assertion::true(is_callable($callback), 'Parameter $callback must be callable');

        $this->callback = $callback;
    }

    /**
     * Get current property value
     *
     * @return mixed
     */
    public function get()
    {
        return call_user_func($this->callback);
    }
}
