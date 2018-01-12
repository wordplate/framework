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

namespace WordPlate\Support;

/**
 * This is the filter class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Filter
{
    /**
     * Hook a function or method to a specific filter action.
     *
     * @see https://developer.wordpress.org/reference/functions/add_filter
     *
     * @param string $tag
     * @param callable $callback
     * @param int $priority
     * @param int $accepted
     *
     * @return bool
     */
    public static function add(string $tag, callable $callback, int $priority = 10, int $accepted = 1): bool
    {
        // Load WordPress's action and filter helper functions.
        require_once ABSPATH.'wp-includes/plugin.php';

        return add_filter($tag, $callback, $priority, $args);
    }

    /**
     * Removes a function from a specified filter hook.
     *
     * @see https://developer.wordpress.org/reference/functions/remove_filter
     *
     * @param string $tag
     * @param callable $callback
     * @param int $priority
     *
     * @return bool
     */
    public static function remove(string $tag, callable $callback, int $priority = 10): bool
    {
        // Load WordPress's filter helper functions.
        require_once ABSPATH.'wp-includes/plugin.php';

        return remove_filter($tag, $callback, $priority);
    }
}
