<?php

/*
* This file is part of WordPlate.
*
 * (c) Vincent Klaiber <hello@doubledip.se>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

declare(strict_types=1);

namespace WordPlate;

use Symfony\Component\Routing\Generator\UrlGenerator;

/**
 * This is the must use plugin loader class.
 *
 * @see https://wordpress.org/support/article/must-use-plugins/
 *
 * @author Daniel Gerdgren <daniel@gerdgren.se>
 * @author Oskar Joelson <oskar@joelson.org>
 * @author Vincent Klaiber <hello@doubledip.se>
 */
final class PluginLoader
{
    /**
     * The loaded must-use plugins.
     *
     * @var array
     */
    protected $plugins;

    /**
     * The active must-use plugins.
     *
     * @var array
     */
    protected $activePlugins;

    /**
     * Run the plugin loader.
     *
     * @return void
     */
    public function load(): void
    {
        // Load WordPress's action and filter helper functions.
        require_once ABSPATH.'wp-includes/plugin.php';

        add_filter('pre_option_active_plugins', [$this, 'preOptionActivePlugins']);
        add_filter('show_advanced_plugins', [$this, 'showAdvancedPlugins'], 0, 2);
        add_filter('option_active_plugins', [$this, 'optionActivePlugins'], PHP_INT_MAX);
        add_filter('pre_update_option_active_plugins', [$this, 'preUpdateOptionActivePlugins']);
    }

    /**
     * Show must-use plugins on the plugins page.
     *
     * @param bool $show
     * @param string $type
     *
     * @return void
     */
    public function showAdvancedPlugins(bool $show, string $type)
    {
        if (!$this->isPluginsScreen() || $type !== 'mustuse' || !current_user_can('activate_plugins')) {
            return $show;
        }

        $GLOBALS['plugins']['mustuse'] = $this->getPlugins();
    }

    /**
     * Active plugins including must-use plugins.
     *
     * @param mixed $plugins
     *
     * @return mixed
     */
    public function preOptionActivePlugins($plugins)
    {
        remove_filter('pre_option_active_plugins', [$this, 'preOptionActivePlugins']);

        if (
            !defined('WP_PLUGIN_DIR') ||
            !defined('WPMU_PLUGIN_DIR') ||
            !is_blog_installed()
        ) {
            return false;
        }

        $this->validatePlugins();

        $haveUnactivatedPlugins = false;
        foreach (array_keys($this->getPlugins()) as $plugin) {
            if ($this->isPluginActive($plugin)) {
                require_once WPMU_PLUGIN_DIR.'/'.$plugin;
            } else {
                $haveUnactivatedPlugins = true;
            }
        }

        if ($haveUnactivatedPlugins) {
            add_action('wp_loaded', [$this, 'activatePlugins']);
        }

        return $plugins;
    }

    /**
     * Add plugins to active plugins, this makes is_plugin_active work.
     *
     * @param array $plugins
     *
     * @return array
     */
    public function optionActivePlugins($plugins): array
    {
        if ($this->isPluginsScreen()) {
            return $plugins;
        }

        foreach (array_keys($this->getPlugins()) as $plugin) {
            $plugins = array_diff($plugins, [$plugin]);
            if ($this->isPluginActive($plugin)) {
                // Remove plugin from array, if exists
                $plugins = array_diff($plugins, [$plugin]);

                // Add plugin with relative url to WPMU_PLUGIN_DIR
                $plugins[] = $this->getRelativePath().$plugin;
            }
        }

        return array_unique($plugins);
    }

    /**
     * Prevent active plugins to contain mu-plugins.
     *
     * @param array $plugins
     *
     * @return array
     */
    public function preUpdateOptionActivePlugins($plugins): array
    {
        return array_filter($plugins, function ($plugin) {
            return !in_array($plugin, $this->getActivePlugins());
        });
    }

    /**
     * Active plugins not activated.
     *
     * @return void
     */
    public function activatePlugins(): void
    {
        foreach (array_keys($this->getPlugins()) as $plugin) {
            if (!$this->isPluginActive($plugin)) {
                $this->activatePlugin($plugin);
            }
        }
    }

    /**
     * Get the plugins and must-use plugins.
     *
     * @return array
     */
    protected function getPlugins(): array
    {
        if ($this->plugins) {
            return $this->plugins;
        }

        // Load WordPress's plugin helper functions.
        require_once ABSPATH.'wp-admin/includes/plugin.php';

        $plugins = array_diff_key(
            get_plugins('/'.$this->getRelativePath()),
            get_mu_plugins()
        );

        $this->plugins = array_unique($plugins, SORT_REGULAR);

        return $this->plugins;
    }

    /**
     * Get the active must-use plugins.
     *
     * @return array
     */
    protected function getActivePlugins(): array
    {
        if ($this->activePlugins) {
            return $this->activePlugins;
        }

        $this->activePlugins = (array) get_option('active_mu_plugins', []);

        return $this->activePlugins;
    }

    /**
     * Set the active must-use plugins.
     *
     * @param array $plugins
     *
     * @return void
     */
    protected function setActivePlugins(array $plugins): void
    {
        $plugins = array_unique($plugins, SORT_REGULAR);

        update_option('active_mu_plugins', $plugins);

        $this->activePlugins = $plugins;
    }

    /**
     * Check whether a plugin is active.
     *
     * @param string $plugin
     *
     * @return bool
     */
    protected function isPluginActive(string $plugin): bool
    {
        return in_array($plugin, $this->getActivePlugins());
    }

    /**
     * Activate plugin by their name.
     *
     * @param string $plugin
     *
     * @return void
     */
    protected function activatePlugin(string $plugin): void
    {
        require_once WPMU_PLUGIN_DIR.'/'.$plugin;

        do_action('activate_'.$plugin);

        $plugins = $this->getActivePlugins();
        $plugins[] = $plugin;

        $this->setActivePlugins($plugins);
    }

    /**
     * Validate active plugins and deactivate invalid plugins.
     *
     * @return void
     */
    protected function validatePlugins(): void
    {
        $plugins = array_filter($this->getActivePlugins(), function ($plugin) {
            return file_exists(WPMU_PLUGIN_DIR.'/'.$plugin);
        });

        if (array_diff($plugins, $this->getActivePlugins())) {
            $this->setActivePlugins($plugins);
        }
    }

    /**
     * Get the relative must-use plugins path.
     *
     * @return string
     */
    protected function getRelativePath(): string
    {
        return UrlGenerator::getRelativePath(
            WP_PLUGIN_DIR.'/',
            WPMU_PLUGIN_DIR.'/'
        );
    }

    /**
     * Check if the current screen is plugins.
     *
     * @return bool
     */
    protected function isPluginsScreen(): bool
    {
        if (!function_exists('get_current_screen')) {
            return false;
        }

        if ($screen = get_current_screen()) {
            return in_array($screen->base, ['plugins', 'plugins-network']);
        }

        return false;
    }
}
