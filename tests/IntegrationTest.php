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
use Symfony\Component\Process\Process;

/**
 * This is the integration test class. It spins up WordPress using built-in
 * server.
 *
 * @author Mikhail Vasin <michaelvasin@gmail.com>
 */
class IntegrationTest extends TestCase
{
    use RetryTrait;

    // Holds web server process, so it will be stopped when the testing is
    // over.
    private static $server;

    // TODO: iterate ports to find a free one, there is
    // no guarantee that a particular port will be available on a test
    // machine
    const HOST = 'localhost:12345';
    const DOCROOT = __DIR__.'/public';

    public static function setUpBeforeClass()
    {
        self::$server = new Process(
            'php -S '.self::HOST.' -t '.self::DOCROOT
        );

        // Start web server in a separate process
        self::$server->start();
    }

    /**
     * @retry 200
     * @sleep 0.01
     */
    public function testSmokeTest()
    {
        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, self::HOST);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // Without a proper database connection it should currently look
        // something like this
        $this->assertRegExp(
            '/Error establishing a database connection/', $output
        );

        // close curl resource to free up system resources
        curl_close($ch);
    }

    public static function tearDownAfterClass()
    {
        self::$server->stop();
    }
}
