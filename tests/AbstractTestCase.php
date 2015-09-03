<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\Tests;

use PHPUnit_Framework_TestCase;
use WordPlate\Application;

/**
 * This is the abstract test case class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
abstract class AbstractTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * The application instance.
     *
     * @var \WordPlate\Application
     */
    public $app;

    /**
     * Setup a new application instance.
     */
    public function setUp()
    {
        $this->app = new Application(realpath(__DIR__));
    }
}
