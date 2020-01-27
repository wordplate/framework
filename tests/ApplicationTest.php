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
use WordPlate\Application;

class ApplicationTest extends TestCase
{
    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testBasePath()
    {
        $application = new Application(__DIR__ . '/stubs');
        $application->run();

        $this->assertInstanceOf(Application::class, $application);
        $this->assertSame(__DIR__ . '/stubs', $application->getBasePath());
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testPublicPath()
    {
        $application = new Application(__DIR__ . '/stubs');
        $application->run();

        $this->assertSame(__DIR__ . '/stubs/public', $application->getPublicPath());

        $application->setPublicPath(__DIR__);
        $this->assertSame(__DIR__, $application->getPublicPath());
    }
}
