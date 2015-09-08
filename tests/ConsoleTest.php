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

use Symfony\Component\Console\Application as SymfonyApplication;
use WordPlate\Console\Application;

/**
 * This is the console test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ConsoleTest extends AbstractTestCase
{
    public function testBindings()
    {
        $app = new Application(__DIR__);
        $this->assertInstanceOf(SymfonyApplication::class, $app);
    }

    public function testPaths()
    {
        $app = new Application(__DIR__);
        $this->assertSame(__DIR__, $app->getBasePath());
    }
}
