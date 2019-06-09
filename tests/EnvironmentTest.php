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

/**
 * This is the environment test class.
 *
 * @author Vincent Klaiber <hello@doubledip.se>
 */
class EnvironmentTest extends TestCase
{
    public function testEnvFunction()
    {
        $this->assertSame('mcfly', env('DOTENV_DEFAULT', 'mcfly'));

        $variables = [
            'DOTENV_FALSE=false' => false,
            'DOTENV_FALSE=(false)' => false,
            'DOTENV_TRUE=true' => true,
            'DOTENV_TRUE=(true)' => true,
            'DOTENV_EMPTY=empty' => '',
            'DOTENV_EMPTY=(empty)' => '',
            'DOTENV_NULL=null' => null,
            'DOTENV_NULL=(null)' => null,
            'DOTENV_QUOTED="null"' => 'null',
            "DOTENV_QUOTED='null'" => 'null',
            "DOTENV_STRING=einstein" => 'einstein',
        ];

        foreach ($variables as $variable => $expected) {
            putenv($variable);
            $this->assertSame($expected, env(explode('=', $variable)[0]));
        }
    }
}
