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

/**
 * This is the application test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ApplicationTest extends TestCase
{
    public function testInvalidPathException()
    {
        $application = new Application(__DIR__.'/stubs');

        putenv('WP_DIR=wp');

        $application->run();

        $this->assertInstanceOf(Application::class, $application);
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testStandard()
    {
        file_put_contents(__DIR__.'/stubs/.env', 'WP_DIR=wp');

        $application = new Application(__DIR__.'/stubs');
        $application->run();

        $this->assertInstanceOf(Application::class, $application);

        $this->assertSame(__DIR__.'/stubs', $application->getBasePath());

        $application->setPublicPath(__DIR__);
        $this->assertSame(__DIR__, $application->getPublicPath());

        unlink(__DIR__.'/stubs/.env');
    }
}
