<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use WordPlate\Exceptions\WordPlateException;

/**
 * Fix home URL on theme activation
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    $url = get_option('home');
    if (ends_with($url, '/wordpress')) {
        update_option('home', str_replace('/wordpress', '', $url));
    }
});

/**
 * Delete WordPlate specific data from database.
 *
 * @return void
 */
add_action('switch_theme', function () {
    if (strlen(config('theme.slug')) <= 0) {
        throw new WordPlateException('Theme slug is not defined in config/theme.php');
    }

    delete_option(config('theme.slug').'_activated');
});
