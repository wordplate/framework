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
 * Add Roots Soil plugin features.
 *
 * @return void
 */
if (count(config('plugins.soil.features')) > 0) {
    foreach (config('plugins.soil.features') as $feature) {
        add_theme_support($feature);
    }
}

/**
 * Activate plugins
 *
 * @return void
 */
if (config('plugins.activate')) {
    add_action('admin_init', function () {

        if (strlen(config('theme.slug')) <= 0) {
            throw new WordPlateException('Theme slug is not defined in config/theme.php');
        }

        $option_key = config('theme.slug').'_activated';

        if (!get_option($option_key)) {

            // Activate installed plugins.
            if (!function_exists('get_plugins')) {
                require_once ABSPATH . 'wp-admin/includes/plugin.php';
            }

            $installed_plugins = get_plugins();

            if (!empty($installed_plugins)) {
                $activated_plugins = get_option('active_plugins');

                foreach ($installed_plugins as $plugin => $value) {
                    if (!in_array($plugin, $activated_plugins)) {
                        $activated_plugins[] = $plugin;

                        do_action('activate_plugin', $plugin);
                        update_option('active_plugins', $activated_plugins);
                        do_action('activate_' . $plugin);
                        do_action('activated_plugin', $plugin);
                    }
                }
            }

            // Set theme is activated to true.
            update_option($option_key, 1);
        }
    });
}
