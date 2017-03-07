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
    public function testStandard()
    {
        $application = new Application(__DIR__.'/stubs');

        $this->assertInstanceOf(Application::class, $application);
    }
}
