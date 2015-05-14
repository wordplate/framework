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
     * @return bool Always true
     */
    public function add()
    {
        return call_user_func('add_action', func_get_args());
    }

    /**
     * Check if a function has a action.
     *
     * @return bool
     */
    public function has()
    {
        return call_user_func('has_action', func_get_args());
    }

    /**
     * Get number of times a action is fired.
     *
     * @return int
     */
    public function did()
    {
        return call_user_func('did_action', func_get_args());
    }

    /**
     * Dispatch a WordPress action.
     */
    public function dispatch()
    {
        return call_user_func('do_action', func_get_args());
    }

    /**
     * Remove a action.
     *
     * @return bool
     */
    public function remove()
    {
        return call_user_func('remove_action', func_get_args());
    }
}
