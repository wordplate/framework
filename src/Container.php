<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace WordPlate;

/**
 * This is the container class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Container
{
    /**
     * The current globally available container (if any).
     *
     * @var static
     */
    protected static $instance;

    /**
     * Set the globally available instance of the container.
     *
     * @return static
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Set the shared instance of the container.
     *
     * @param \WordPlate\Container|null $container
     *
     * @return static
     */
    public static function setInstance(self $container = null)
    {
        return static::$instance = $container;
    }
}
