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

use Shopery\View\Exception\UndefinedPropertyException;
use Shopery\View\Property\Property;
use Shopery\View\View;

/**
 * Class DynamicView
 *
 * @author Berny Cantos <be@rny.cc>
 */
class DynamicView implements View
{
    /**
     * Properties
     *
     * @var array
     */
    private $properties;

    /**
     * Constructor
     *
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        $this->properties = $properties;
    }

    /**
     * Check whether a property is defined in the view
     *
     * @param string $propertyName
     *
     * @return bool
     */
    public function __isset($propertyName)
    {
        return array_key_exists($propertyName, $this->properties);
    }

    /**
     * Return property value in the view
     *
     * @param string $propertyName
     *
     * @return bool
     */
    public function __get($propertyName)
    {
        if (!isset($this->properties[$propertyName])) {
            throw new UndefinedPropertyException();
        }

        $value = $this->properties[$propertyName];
        if ($value instanceof Property) {
            $value = $value->get();
        }

        return $value;
    }
}
