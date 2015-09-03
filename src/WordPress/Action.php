<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\WordPress;

/**
 * This is the action class.
 *
 * @author Fredrik Forsmo <fredrik.forsmo@gmail.com>
 */
class Action
{
    /**
     * Add WordPress action.
     *
     * @param string $hook
     * @param callable $callback
     * @param int $priority
     * @param int $args
     *
     * @return bool
     */
    public function add($hook, callable $callback, $priority = 10, $args = 1)
    {
        return add_action($hook, $callback, $priority, $args);
    }
}
