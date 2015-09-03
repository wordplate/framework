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
 * This is the filter class.
 *
 * @author Fredrik Forsmo <fredrik.forsmo@gmail.com>
 */
class Filter
{
    /**
     * Add WordPress filter.
     *
     * @param string $hook
     * @param $callback
     * @param int $priority
     * @param int $args
     *
     * @return bool
     */
    public function add($hook, callable $callback, $priority = 10, $args = 1)
    {
        return add_filter($hook, $callback, $priority, $args);
    }
}
