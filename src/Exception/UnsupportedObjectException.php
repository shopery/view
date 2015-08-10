<?php

/*
 * This file is part of the xphere\view package
 *
 * (c) Berny Cantos <be@rny.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace xPheRe\View\Exception;

/**
 * Class UnsupportedObjectException
 *
 * Thrown when creating a View from an unsupported object
 *
 * @author Berny Cantos <be@rny.cc>
 */
class UnsupportedObjectException extends \UnexpectedValueException implements Exception
{
}
