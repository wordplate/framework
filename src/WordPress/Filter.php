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
     * @return bool
     */
    public function add()
    {
        return call_user_func('add_filter', func_get_args());
    }

    /**
     * Check if a function has a filter.
     *
     * @return bool
     */
    public function has()
    {
        return call_user_func('has_filter', func_get_args());
    }

    /**
     * Get the current filter.
     *
     * @return string
     */
    public function current()
    {
        return call_user_func('current_filter', func_get_args());
    }

    /**
     * Dispatch a WordPress filter.
     */
    public function dispatch()
    {
        return call_user_func('apply_filters', func_get_args());
    }

    /**
     * Remove a filter.
     *
     * @return bool
     */
    public function remove()
    {
        return call_user_func('remove_filter', func_get_args());
    }

    /**
     * Remove all filters.
     *
     * @return bool
     */
    public function removeAll()
    {
        return call_user_func('remove_all_filter', func_get_args());
    }
}
