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
use WordPlate\Application;

/**
 * This is the application test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ApplicationTest extends AbstractTestCase
{
    public function testGetSet()
    {
        $app = new Application();

        $this->assertInstanceOf(Container::class, $app);
        $this->assertInstanceOf(Repository::class, $app->config);
    }

    public function testPaths()
    {
        $app = new Application(__DIR__);

        $this->assertEquals(__DIR__, $app->getBasePath());
        $this->assertEquals(__DIR__, $app->getEnvironmentPath());
        $this->assertEquals(__DIR__.'/config', $app->getConfigPath());
        $this->assertEquals('.env', $app->getEnvironmentFile());
    }
}
