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

use Exception;
use Illuminate\Support\HtmlString;
use PHPUnit\Framework\TestCase;
use WordPlate\Application;

/**
 * This is the helpers test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class HelpersTest extends TestCase
{
    public function testAsset()
    {
        $this->assertSame('https://wordplate.dev/favicon.ico', asset('favicon.ico'));
        $this->assertSame('https://wordplate.dev/favicon.ico', asset('/favicon.ico'));
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
        mkdir(__DIR__.'/stubs/assets');
        file_put_contents(__DIR__.'/stubs/assets/mix-manifest.json', '{"/1955.js": "/1955-740b8162ec.js"}');

        $this->assertSame('https://wordplate.dev/assets/1955-740b8162ec.js', (string) mix('1955.js'));
        $this->assertInstanceOf(HtmlString::class, mix('1955.js'));

        unlink(__DIR__.'/stubs/assets/mix-manifest.json');
        rmdir(__DIR__.'/stubs/assets');
    }

    /**
     * @runInSeparateProcess
     */
    public function testMixMissingManifest()
    {
        try {
            mix('1985.js');
        } catch (Exception $e) {
            $this->assertSame('The Mix manifest does not exist.', $e->getMessage());
        }
    }

    public function testMixMissingFile()
    {
        mkdir(__DIR__.'/stubs/assets');
        file_put_contents(__DIR__.'/stubs/assets/mix-manifest.json', '{}');

        try {
            mix('2015.js');
        } catch (Exception $e) {
            $this->assertSame('Unable to locate Mix file: /2015.js. Please check your webpack.mix.js output paths and try again.', $e->getMessage());
        }

        unlink(__DIR__.'/stubs/assets/mix-manifest.json');
        rmdir(__DIR__.'/stubs/assets');
    }

    public function testTemplatePath()
    {
        $this->assertSame(__DIR__.'/stubs/partials/navigation.php', template_path('partials/navigation.php'));
    }

    public function testBasePath()
    {
        new Application(__DIR__);

        $this->assertSame(__DIR__, base_path());
        $this->assertSame(__DIR__.'/88mph.php', base_path('88mph.php'));
    }
}
