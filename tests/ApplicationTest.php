<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\Tests;

use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use ReflectionClass;
use WordPlate\Application;

/**
 * This is the application test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ApplicationTest extends AbstractTestCase
{
    public function testBindings()
    {
        $app = new Application();
        $this->assertInstanceOf(Container::class, $app);
        $this->assertInstanceOf(Container::class, app());
        $this->assertInstanceOf(Repository::class, $app->config);
        $this->assertInstanceOf(Repository::class, config());
    }

    public function testPaths()
    {
        $app = new Application(__DIR__);
        $this->assertSame(__DIR__, $app->getBasePath());
        $this->assertSame(__DIR__, $app->getEnvironmentPath());
        $this->assertSame(__DIR__.'/config', $app->getConfigPath());
        $this->assertSame('.env', $app->getEnvironmentFile());
        $app->setBasePath('delorean/marty/mcfly');
        $this->assertSame('delorean/marty/mcfly', $app->getBasePath());
    }

    public function testEnvironment()
    {
        (new Application(__DIR__))->bootstrap();
        $this->assertSame('local', env('WP_ENV'));
    }

    public function testConfig()
    {
        $app = new Application(__DIR__);
        $app->bootstrap();
        $this->assertSame(true, config('theme.debug'));
        $this->assertSame(true, $app['config']['theme.debug']);
        $this->assertSame('UTC', date_default_timezone_get());
        $this->assertNull(config('illbeback'));
    }

    public function testBootstrappers()
    {
        $app = new ReflectionClass(Application::class);
        $bootstrappers = $app->getDefaultProperties()['bootstrappers'];

        foreach ($bootstrappers as $bootstrapper) {
            $class = new ReflectionClass($bootstrapper);
            $this->assertTrue($class->isFinal());
            $this->assertTrue($class->hasMethod('bootstrap'));
        }
    }

    public function testComponents()
    {
        $class = new ReflectionClass(Application::class);
        $components = $class->getDefaultProperties()['components'];

        foreach ($components as $component) {
            $class = new ReflectionClass($component);
            $this->assertTrue($class->isFinal());
            $this->assertTrue($class->hasMethod('register'));
        }
    }
}
