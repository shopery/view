<?php

/*
 * This file is part of the shopery\view package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopery\View;

use Assert\Assertion;

use Shopery\View\Exception\UndefinedPropertyException;

/**
 * Class ObjectView
 *
 * Enapsulate an object with multiple methods into a view
 *
 * @author Berny Cantos <be@rny.cc>
 */
class ObjectView implements View
{
    /**
     * Object
     *
     * @var object
     */
    private $object;

    /**
     * Properties of the object
     *
     * @var array
     */
    private $properties;

    /**
     * @param $object
     */
    public function __construct($object, array $properties)
    {
        Assertion::true(is_object($object));
        foreach ($properties as $callable) {
            Assertion::true(is_callable([$object, $callable]));
        }

        $this->object = $object;
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
        if (!$this->__isset($propertyName)) {
            throw new UndefinedPropertyException();
        }

        return $this->object->{$this->properties[$propertyName]}();
    }
}
