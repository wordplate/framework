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
use Symfony\Component\HttpFoundation\Request;

/**
 * This is the helpers test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class HelpersTest extends TestCase
{
    public function testElixir()
    {
        $this->assertSame('https://localhost/../stubs/1984-740b8162ec.js', elixir('1984.js', '../stubs'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testElixirException()
    {
        elixir('1955.js', '../stubs');
    }

    public function testEnv()
    {
        $this->assertSame('testing', env('WP_ENV'));

        putenv('WP_THEME=marty');
        $this->assertSame('marty', env('WP_THEME'));

        $this->assertSame('mcfly', env('WP_DEBUG', 'mcfly'));

        putenv('WP_TEST=(true)');
        $this->assertTrue(env('WP_TEST'));

        putenv('WP_TEST=(false)');
        $this->assertFalse(env('WP_TEST'));

        putenv('WP_TEST=(empty)');
        $this->assertEmpty(env('WP_TEST'));

        putenv('WP_TEST=(null)');
        $this->assertNull(env('WP_TEST'));

        putenv('WP_TEST="einstein"');
        $this->assertSame('einstein', env('WP_TEST'));
    }

    public function testMix()
    {
        $this->assertSame('https://localhost/assets/1955-740b8162ec.js', (string) mix('1955.js'));
    }

    public function testRequest()
    {
        $this->assertInstanceOf(Request::class, request());
    }
}
