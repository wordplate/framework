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

namespace WordPlate\Tests;

use PHPUnit\Framework\TestCase;
use ReflectionMethod;
use WordPlate\PluginLoader;

/**
 * This is the plugin loader test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class PluginLoaderTest extends TestCase
{
    public function testLoad()
    {
        $this->definePaths();
        $pluginLoader = new PluginLoader();

        $this->assertNull($pluginLoader->load());
    }

    public function testShowAdvancedPlugins()
    {
        $this->definePaths();
        $pluginLoader = new PluginLoader();

        $this->assertFalse($pluginLoader->showAdvancedPlugins(false, 'notmustuse'));
        $this->assertNull($pluginLoader->showAdvancedPlugins(false, 'mustuse'));
    }

    public function testPreOptionActivePlugins()
    {
        $this->definePaths();
        $pluginLoader = new PluginLoader();

        $this->assertFalse($pluginLoader->preOptionActivePlugins(false));
    }

    public function testOptionActivePlugins()
    {
        $this->definePaths();
        $pluginLoader = new PluginLoader();

        $activePlugins = $pluginLoader->optionActivePlugins(['mcfly/marty.php']);
        $this->assertEquals(1, count($activePlugins));
        $this->assertEquals('mcfly/marty.php', $activePlugins[0]);
    }

    public function testGetPlugins()
    {
        $this->definePaths();
        $reflectionMethod = new ReflectionMethod('WordPlate\PluginLoader', 'getPlugins');
        $reflectionMethod->setAccessible(true);
        $plugins = $reflectionMethod->invoke(new PluginLoader());

        $this->assertArrayHasKey('./../mu-plugins/emmett/brown.php', $plugins);
    }

    protected function definePaths()
    {
        if (!defined('ABSPATH')) {
            define('ABSPATH', __DIR__.'/stubs/public/wordpress/');
        }

        if (!defined('WP_PLUGIN_DIR')) {
            define('WP_PLUGIN_DIR', __DIR__.'/stubs/public/plugins');
        }

        if (!defined('WPMU_PLUGIN_DIR')) {
            define('WPMU_PLUGIN_DIR', __DIR__.'/stubs/public/mu-plugins');
        }
    }
}
