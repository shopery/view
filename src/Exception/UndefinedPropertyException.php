<?php

/*
 * This file is part of the shopery\view package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopery\View\Exception;

/**
 * Class UndefinedPropertyException
 *
 * Thrown when a given property can't be found in a view
 *
 * @author Berny Cantos <be@rny.cc>
 */
class UndefinedPropertyException extends \UnexpectedValueException implements Exception
{
}
