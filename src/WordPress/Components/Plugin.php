<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\WordPress\Components;

use WordPlate\Exceptions\WordPlateException;

/**
 * This is the plugin component class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Plugin extends AbstractComponent
{
    /**
     * Bootstrap the component.
     *
     * @return void
     */
    public function bootstrap()
    {
        $this->registerSoil();

        $this->action->add('admin_init', [$this, 'activatePlugins']);
    }

    /**
     * Activate plugins.
     *
     * @throws \WordPlate\Exceptions\WordPlateException
     *
     * @return void
     */
    public function activatePlugins()
    {
        if (!config('plugins.activate')) {
            return;
        }

        if (strlen(config('theme.slug')) <= 0) {
            throw new WordPlateException('Theme slug is not defined in config/theme.php');
        }

        $option_key = config('theme.slug').'_activated';

        if (!get_option($option_key)) {

            // Activate installed plugins.
            if (!function_exists('get_plugins')) {
                require_once ABSPATH.'wp-admin/includes/plugin.php';
            }

            $installed_plugins = get_plugins();

            if (!empty($installed_plugins)) {
                $activated_plugins = get_option('active_plugins');

                foreach ($installed_plugins as $plugin => $value) {
                    if (!in_array($plugin, $activated_plugins)) {
                        $activated_plugins[] = $plugin;

                        do_action('activate_plugin', $plugin);
                        update_option('active_plugins', $activated_plugins);
                        do_action('activate_'.$plugin);
                        do_action('activated_plugin', $plugin);
                    }
                }
            }

            // Set theme is activated to true.
            update_option($option_key, 1);
        }
    }
}
