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
     * The current globally available containers (if any).
     *
     * @var static
     */
    protected static $instances = [];

    /**
     * Set the globally available instance of the containers.
     *
     * @return static
     */
    public static function getInstance()
    {
        if (!isset(self::$instances[static::class])) {
            self::$instances[static::class] = new static();
        }

        return self::$instances[static::class];
    }

    /**
     * Set the shared instance of the containers.
     *
     * @param \WordPlate\Container|null $container
     *
     * @return static
     */
    public static function setInstance(self $container = null)
    {
        self::$instances[static::class] = $container;
    }
}
