<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (config('app.updates', false) && !current_user_can('manage_options')) {
    /*
     * Disable all core updates.
     */
    define('WP_AUTO_UPDATE_CORE', false);

    /*
     * Disable plugin and theme update and installation.
     */
    define('DISALLOW_FILE_MODS', true);
}
