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

/**
 * This is the abstract test case class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
abstract class AbstractTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Setup the test suit.
     *
     * @return void
     */
    public function setUp()
    {
        mkdir(__DIR__.'/config');
        file_put_contents(__DIR__.'/.env', 'WP_ENV=local');
        file_put_contents(__DIR__.'/config/theme.php', '<?php return ["debug" => true];');
    }

    /**
     * Tear down the test suit.
     *
     * @return void
     */
    public function tearDown()
    {
        @unlink(__DIR__.'/.env');
        @unlink(__DIR__.'/config/theme.php');
        @rmdir(__DIR__.'/config');
    }
}
