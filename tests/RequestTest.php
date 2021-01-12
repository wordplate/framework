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
use WordPlate\Request;

class RequestTest extends TestCase
{
    public function testGetSchemeAndHttpHost()
    {
        $this->assertSame('http://mcfly.dev', Request::getSchemeAndHttpHost());
    }
}
