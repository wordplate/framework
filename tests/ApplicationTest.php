<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\WordPlate;

use PHPUnit_Framework_TestCase;

/**
 * This is the application test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ApplicationTest extends PHPUnit_Framework_TestCase
{
    /**
     * This is a stupid test, I know! This is just to
     * bootstrap our tests. More coming in the future.
     *
     * @return void
     */
    public function testApplicationInstance()
    {
        $this->assertFileExists(__DIR__.'/../src/Foundation/Application.php');
    }
}
