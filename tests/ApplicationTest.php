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

namespace WordPlate\Tests;

use PHPUnit\Framework\TestCase;
use WordPlate\Application;

/**
 * This is the application test class.
 *
 * @author Vincent Klaiber <hello@doubledip.se>
 */
class ApplicationTest extends TestCase
{
    protected static $application;

    public static function setUpBeforeClass(): void
    {
        self::$application = new Application(__DIR__.'/stubs');
        self::$application->run();
    }

    public function testBasePath()
    {
        $this->assertInstanceOf(Application::class, self::$application);
        $this->assertSame(__DIR__.'/stubs', self::$application->getBasePath());
    }

    public function testPublicPath()
    {
        self::$application->setPublicPath(__DIR__);
        $this->assertSame(__DIR__, self::$application->getPublicPath());
    }
}
