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
 * Class ChainedView
 *
 * Chains multiple views
 *
 * @author Berny Cantos <be@rny.cc>
 */
class ChainedView implements View
{
    /**
     * Chained views
     *
     * @var View[]
     */
    private $views;

    /**
     * @param array $views
     */
    public function __construct(array $views)
    {
        Assertion::allIsInstanceOf($views, View::class);

        $this->views = $views;
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
        foreach ($this->views as $view) {
            if (isset($view->{$propertyName})) {
                return true;
            }
        }

        return false;
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
        foreach ($this->views as $view) {
            if (isset($view->{$propertyName})) {
                return $view->{$propertyName};
            }
        }

        throw new UndefinedPropertyException();
    }
}
