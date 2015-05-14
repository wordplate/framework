<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\Tests\Foundation;

use Exception;
use PHPUnit_Framework_TestCase;
use WordPlate\Foundation\Application;

/**
 * This is the application test class.
 *
 * @author Fredrik Forsmo <fredrik.forsmo@gmail.com>
 */
class ApplicationTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test application class.
     *
     * @return void
     */
    public function testApplicationClass()
    {
        try {
            new Application;
        } catch (Exception $e) {
            $this->assertEquals('The "/config" directory does not exist.', $e->getMessage());
        }
    }
}
