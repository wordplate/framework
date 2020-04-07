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
use Symfony\Component\Dotenv\Dotenv;

class EnvironmentTest extends TestCase
{
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

        $environment = new Dotenv();

        foreach ($variables as [$key, $value, $expected]) {
            $environment->populate([$key => $value]);
            $this->assertSame($expected, env($key));
        }
    }
}
