<?php

/**
 * Copyright (c) Vincent Klaiber.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/wordplate/framework
 */

declare(strict_types=1);

namespace WordPlate\Tests;

use PHPUnit\Framework\TestCase;
use ReflectionMethod;
use WordPlate\PluginLoader;

class PluginLoaderTest extends TestCase
{
    /**
     * @var \WordPlate\PluginLoader
     */
    protected $pluginLoader;

    protected function setUp(): void
    {
        if (!defined('ABSPATH')) {
            define('ABSPATH', __DIR__ . '/stubs/public/wordpress/');
        }

        if (!defined('WP_PLUGIN_DIR')) {
            define('WP_PLUGIN_DIR', __DIR__ . '/stubs/public/plugins');
        }

        if (!defined('WPMU_PLUGIN_DIR')) {
            define('WPMU_PLUGIN_DIR', __DIR__ . '/stubs/public/mu-plugins');
        }

        $this->pluginLoader = new PluginLoader();
    }

    public function testLoad()
    {
        $this->pluginLoader->load();
    }

    public function testShowAdvancedPlugins()
    {
        $this->assertFalse($this->pluginLoader->showAdvancedPlugins(false, 'notmustuse'));
        $this->assertNull($this->pluginLoader->showAdvancedPlugins(false, 'mustuse'));
    }

    public function testPreOptionActivePlugins()
    {
        $this->assertFalse($this->pluginLoader->preOptionActivePlugins(false));
    }

    public function testOptionActivePlugins()
    {
        $activePlugins = $this->pluginLoader->optionActivePlugins(['mcfly/marty.php']);

        $this->assertCount(1, $activePlugins);
        $this->assertEquals('mcfly/marty.php', $activePlugins[0]);
    }

    public function testGetPlugins()
    {
        $reflectionMethod = new ReflectionMethod(PluginLoader::class, 'getPlugins');
        $reflectionMethod->setAccessible(true);
        $plugins = $reflectionMethod->invoke($this->pluginLoader);

        $this->assertArrayHasKey('./../mu-plugins/emmett/brown.php', $plugins);
    }

    public function testPreUpdateOptionActivePlugins()
    {
        $plugins = $this->pluginLoader->preUpdateOptionActivePlugins(['plate']);

        $this->assertIsArray($plugins);
        $this->assertCount(1, $plugins);
    }
}
