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
    public function testInvalidPathException()
    {
        $basePath = __DIR__.'/stubs';
        $application = new Application($basePath);

        putenv('WP_DIR=wordpress');

        $application->run();

        $this->assertInstanceOf(Application::class, $application);
        $this->assertSame($basePath, $application->getBasePath());
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testStandard()
    {
        file_put_contents(__DIR__.'/stubs/.env', 'WP_DIR=wordpress');

        $application = new Application(__DIR__.'/stubs');
        $application->run();

        $this->assertInstanceOf(Application::class, $application);

        $application->setPublicPath(__DIR__);
        $this->assertSame(__DIR__, $application->getPublicPath());

        unlink(__DIR__.'/stubs/.env');
    }
}
