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

use Exception;
use PHPUnit\Framework\TestCase;

/**
 * This is the laravel mix test class.
 *
 * @author Vincent Klaiber <hello@doubledip.se>
 */
class LaravelMixTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        mkdir(__DIR__.'/stubs/child-theme');
        mkdir(__DIR__.'/stubs/child-theme/assets');
    }

    public function testMissingManifestFile()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('The Mix manifest does not exist.');

        mix('1985.js');
    }

    /**
     * @depends testMissingManifestFile
     */
    public function testMissingFilePath()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Unable to locate Mix file: /2015.js. Please check your webpack.mix.js output paths and try again.');

        file_put_contents(__DIR__.'/stubs/child-theme/assets/mix-manifest.json', '{}');

        mix('2015.js');
    }

    /**
     * @depends testMissingManifestFile
     */
    public function testMixFunction()
    {
        file_put_contents(__DIR__.'/stubs/child-theme/assets/mix-manifest.json', '{"/1955.js": "/1955.js?id=12345"}');

        $this->assertSame('https://wordplate.dev/wp-content/themes/child-theme/assets/1955.js?id=12345', (string) mix('1955.js'));
    }

    public static function tearDownAfterClass(): void
    {
        unlink(__DIR__.'/stubs/child-theme/assets/mix-manifest.json');
        rmdir(__DIR__.'/stubs/child-theme/assets');
        rmdir(__DIR__.'/stubs/child-theme');
    }
}
