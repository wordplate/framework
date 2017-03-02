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
use WordPlate\Http\Request;

/**
 * This is the request test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class RequestTest extends TestCase
{
    public function testGetHost()
    {
        $request = new Request();

        $this->assertEmpty($request->getHost());

        $_SERVER['SERVER_ADDR'] = '127.0.0.1';
        $this->assertSame('127.0.0.1', $request->getHost());

        $_SERVER['SERVER_NAME'] = 'mcfly.dev';
        $this->assertSame('mcfly.dev', $request->getHost());

        $_SERVER['HTTP_HOST'] = 'marty.dev';
        $this->assertSame('marty.dev', $request->getHost());
    }

    public function testScheme()
    {
        $request = new Request();

        $this->assertSame('http', $request->getScheme());

        $_SERVER['HTTPS'] = 'off';
        $this->assertSame('http', $request->getScheme());

        $_SERVER['HTTPS'] = 'on';
        $this->assertSame('https', $request->getScheme());
    }
}
