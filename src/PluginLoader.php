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

namespace WordPlate;

use Symfony\Component\Routing\Generator\UrlGenerator;

/**
 * This is the must use plugin loader class.
 *
 * @see https://codex.wordpress.org/Must_Use_Plugins
 *
 * @author Daniel Gerdgren <tditlu@users.noreply.github.com>
 * @author Vincent Klaiber <hello@vinkla.com>
 * @author Oskar Joelson <oskar@joelson.org>
 */
final class PluginLoader
{
    /**
     * The loaded must-use plugins.
     *
     * @var array
     */
    public $plugins;

    /**
     * Run the plugin loader.
     *
     * @return void
     */
    public function load(): void
    {
        // Load WordPress's action and filter helper functions.
        require_once ABSPATH.'wp-includes/plugin.php';

        add_filter('pre_option_active_plugins', [$this, 'activatePlugins']);
        add_filter('show_advanced_plugins', [$this, 'showAdvancedPlugins'], 0, 2);
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
     * @param array $plugins
     *
     * @return bool
     */
    public function activatePlugins($plugins): bool
    {
        remove_filter('pre_option_active_plugins', [$this, 'activatePlugins']);

        if (
            !defined('WP_PLUGIN_DIR') ||
            !defined('WPMU_PLUGIN_DIR') ||
            !is_blog_installed()
        ) {
            return false;
        }

        foreach (array_keys($this->getPlugins()) as $plugin) {
            // include all plugins, whether they are activated or not
            // TODO check which plugins are activated and only include them (to possible save run time)
            require_once WPMU_PLUGIN_DIR.'/'.$plugin;
        }

        // 'after_setup_theme' is the last hook called by wp-settings.php before 'init'.
        // This is an attempt to run plugin activation somewhere after 'plugins_loaded' (which makes the disable-embeds plugin try to access $wp_rewrite before it's initialized)
        // and before 'init' (since the polylang plugin needs to have it's activation being run after the 'init' hook (where it sets up it's default options)).
        add_action('after_setup_theme', function () use ($plugin) {
            foreach (array_keys($this->getPlugins()) as $plugin) {
                // activate all plugins whether they've already been activated before
                // TODO check which plugins aren't already activated first (to possible save run time)
                do_action('activate_'.$plugin);
            }
        });

        return $plugins;
    }

    /**
     * Get the plugins and must-use plugins.
     *
     * @return array
     */
    public function getPlugins(): array
    {
        if ($this->plugins) {
            return $this->plugins;
        }

        // Load WordPress's plugin helper functions.
        require_once ABSPATH.'wp-admin/includes/plugin.php';

        $plugins = array_diff_key(
            get_plugins($this->getRelativePath()),
            get_mu_plugins()
        );

        $this->plugins = array_unique($plugins, SORT_REGULAR);

        return $this->plugins;
    }

    /**
     * Get the relative must-use plugins path.
     *
     * @return string
     */
    public function getRelativePath(): string
    {
        $relativePath = UrlGenerator::getRelativePath(
            WP_PLUGIN_DIR.'/',
            WPMU_PLUGIN_DIR.'/'
        );

        return '/'.$relativePath;
    }

    /**
     * Check if the current screen is plugins.
     *
     * @return bool
     */
    public function isPluginsScreen(): bool
    {
        $screen = get_current_screen();

        return in_array($screen->base, ['plugins', 'plugins-network']);
    }
}
