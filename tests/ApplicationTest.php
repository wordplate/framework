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
        $application = new Application(__DIR__);
        $application->run();

        $this->assertInstanceOf(Application::class, $application);
        $this->assertSame(__DIR__, $application->getBasePath());
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testPublicPath()
    {
        $application = new Application(__DIR__);
        $application->run();

        $this->assertSame(__DIR__ . DIRECTORY_SEPARATOR . 'public', $application->getPublicPath());

        $application->setPublicPath(__DIR__);
        $this->assertSame(__DIR__, $application->getPublicPath());
    }

    public function testEnvFunction()
    {
        $this->assertSame('mcfly', env('DOTENV_DEFAULT', 'mcfly'));

        $variables = [
            ['DOTENV_FALSE', 'false', false],
            ['DOTENV_FALSE', '(false)', false],
            ['DOTENV_TRUE', 'true', true],
            ['DOTENV_TRUE', '(true)', true],
            ['DOTENV_EMPTY', 'empty', ''],
            ['DOTENV_EMPTY', '(empty)', ''],
            ['DOTENV_NULL', 'null', null],
            ['DOTENV_NULL', '(null)', null],
            ['DOTENV_QUOTED', '"null"', 'null'],
            ['DOTENV_QUOTED', "'null'", 'null'],
            ['DOTENV_STRING', 'einstein', 'einstein'],
        ];

        foreach ($variables as [$key, $value, $expected]) {
            $_ENV[$key] = $value;
            $this->assertSame($expected, env($key));
        }
    }
}
