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
use WordPlate\Application;
use WordPlate\Container;

require_once __DIR__.'/stubs.php';

/**
 * This is the container test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ContainerTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testGetInstance()
    {
        $this->assertInstanceOf(Container::class, Container::getInstance());
    }

    public function testSetInstance()
    {
        Container::setInstance(new Application(__DIR__));

        $this->assertInstanceOf(Application::class, Container::getInstance());
    }
}
