<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\Exceptions;

use InvalidArgumentException;

/**
 * This is the invalid config type exception class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class InvalidConfigTypeException extends InvalidArgumentException
{
    /**
     * Create a new invalid configuration exception instance.
     *
     * @param string $configuration
     * @param string $type
     */
    public function __construct($configuration, $type)
    {
        parent::__construct("The configuration $configuration be of type $type");
    }
}
