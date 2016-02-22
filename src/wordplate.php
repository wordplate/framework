<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Plugin Name: WordPlate
 * Plugin URI: https://github.com/wordplate/wordplate
 * Description: Framework for the WordPlate boilerplate.
 * Author: Vincent Klaiber
 * Author URI: https://vinkla.com
 * Version: 1.0.0.
 */

/*
 * Boot the plugin.
 */
add_action('plugins_loaded', function () {
    add_action('after_setup_theme', function () {
        global $_wp_theme_features;

        foreach (glob(__DIR__.'/components/*.php') as $file) {
            $feature = 'plate-'.basename($file, '.php');

            if (isset($_wp_theme_features[$feature])) {
                require $file;
            }
        }
    }, 100);
});
