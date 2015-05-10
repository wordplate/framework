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

/*
 * Enable Gzip if available.
 */
if (extension_loaded('zlib') && (ini_get('output_handler') !== 'ob_gzhandler') && config('theme.gzip')) {
    add_action('wp', create_function('', '@ob_end_clean();@ini_set("zlib.output_compression", 1);'));
}

/*
 * Prevent file edit from WordPress administrator dashboard.
 */
if (!defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', config('theme.disallow_file_edit'));
}

/*
 * Delete WordPlate specific data from database.
 */
add_action('switch_theme', function () {
    if (strlen(config('theme.slug')) <= 0) {
        throw new WordPlateException('Theme slug is not defined in config/theme.php');
    }

    delete_option(config('theme.slug').'_activated');
});

/*
 * Add HTML5 tag support.
 */
add_action('after_setup_theme', function () {
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'widgets',
    ]);
});
