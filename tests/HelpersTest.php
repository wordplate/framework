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
use Illuminate\Support\HtmlString;
use PHPUnit\Framework\TestCase;
use WordPlate\Application;

/**
 * This is the helpers test class.
 *
 * @author Vincent Klaiber <hello@doubledip.se>
 */
class HelpersTest extends TestCase
{
    public function testAsset()
    {
        $this->assertSame('https://wordplate.dev/wp-content/themes/child-theme/style.css', stylesheet_url('style.css'));
        $this->assertSame('https://wordplate.dev/wp-content/themes/child-theme/style.css', stylesheet_url('/style.css'));
    }

    public function testBasePath()
    {
        new Application(__DIR__);

        $this->assertSame(__DIR__, base_path());
        $this->assertSame(__DIR__.'/88mph.php', base_path('88mph.php'));
    }

    /**
     * @runInSeparateProcess
     */
    public function testMix()
    {
        mkdir(__DIR__.'/stubs/child-theme');
        mkdir(__DIR__.'/stubs/child-theme/assets');
        file_put_contents(__DIR__.'/stubs/child-theme/assets/mix-manifest.json', '{"/1955.js": "/1955.js?id=740b8162ec"}');

        $this->assertInstanceOf(HtmlString::class, mix('1955.js'));
        $this->assertSame('https://wordplate.dev/wp-content/themes/child-theme/assets/1955.js?id=740b8162ec', (string) mix('1955.js'));

        mkdir(__DIR__.'/stubs/child-theme/assets/hot');
        $this->assertSame('//localhost:8080/1955.js', (string) mix('1955.js'));

        unlink(__DIR__.'/stubs/child-theme/assets/mix-manifest.json');
        rmdir(__DIR__.'/stubs/child-theme/assets/hot');
        rmdir(__DIR__.'/stubs/child-theme/assets');
        rmdir(__DIR__.'/stubs/child-theme');
    }

    /**
     * @runInSeparateProcess
     */
    public function testMixMissingFile()
    {
        mkdir(__DIR__.'/stubs/child-theme');
        mkdir(__DIR__.'/stubs/child-theme/assets');
        file_put_contents(__DIR__.'/stubs/child-theme/assets/mix-manifest.json', '{}');

        try {
            mix('2015.js');
        } catch (Exception $e) {
            $this->assertSame('Unable to locate Mix file: /2015.js. Please check your webpack.mix.js output paths and try again.', $e->getMessage());
        }

        unlink(__DIR__.'/stubs/child-theme/assets/mix-manifest.json');
        rmdir(__DIR__.'/stubs/child-theme/assets');
        rmdir(__DIR__.'/stubs/child-theme');
    }

    /**
     * @runInSeparateProcess
     */
    public function testMixMissingManifest()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('The Mix manifest does not exist.');

        mix('1985.js');
    }

    public function testStylesheetPath()
    {
        $this->assertSame(__DIR__.'/stubs/child-theme', stylesheet_path());
        $this->assertSame(__DIR__.'/stubs/child-theme/', stylesheet_path('/'));

        $this->assertSame(__DIR__.'/stubs/child-theme/partials', stylesheet_path('partials'));
        $this->assertSame(__DIR__.'/stubs/child-theme/partials', stylesheet_path('/partials'));
        $this->assertSame(__DIR__.'/stubs/child-theme/partials/', stylesheet_path('/partials/'));

        $this->assertSame(__DIR__.'/stubs/child-theme/partials/navigation.php', stylesheet_path('partials/navigation.php'));
        $this->assertSame(__DIR__.'/stubs/child-theme/partials/navigation.php', stylesheet_path('/partials/navigation.php'));
    }

    public function testStylesheetUrl()
    {
        $this->assertSame('https://wordplate.dev/wp-content/themes/child-theme', stylesheet_url());
        $this->assertSame('https://wordplate.dev/wp-content/themes/child-theme/', stylesheet_url('/'));

        $this->assertSame('https://wordplate.dev/wp-content/themes/child-theme/assets', stylesheet_url('assets'));
        $this->assertSame('https://wordplate.dev/wp-content/themes/child-theme/assets', stylesheet_url('/assets'));
        $this->assertSame('https://wordplate.dev/wp-content/themes/child-theme/assets/', stylesheet_url('/assets/'));

        $this->assertSame('https://wordplate.dev/wp-content/themes/child-theme/style.css', stylesheet_url('style.css'));
        $this->assertSame('https://wordplate.dev/wp-content/themes/child-theme/style.css', stylesheet_url('/style.css'));
    }

    public function testTemplatePath()
    {
        $this->assertSame(__DIR__.'/stubs/parent-theme', template_path());
        $this->assertSame(__DIR__.'/stubs/parent-theme/', template_path('/'));

        $this->assertSame(__DIR__.'/stubs/parent-theme/partials', template_path('partials'));
        $this->assertSame(__DIR__.'/stubs/parent-theme/partials', template_path('/partials'));
        $this->assertSame(__DIR__.'/stubs/parent-theme/partials/', template_path('/partials/'));

        $this->assertSame(__DIR__.'/stubs/parent-theme/partials/navigation.php', template_path('partials/navigation.php'));
        $this->assertSame(__DIR__.'/stubs/parent-theme/partials/navigation.php', template_path('/partials/navigation.php'));
    }

    public function testTemplateUrl()
    {
        $this->assertSame('https://wordplate.dev/wp-content/themes/parent-theme', template_url());
        $this->assertSame('https://wordplate.dev/wp-content/themes/parent-theme/', template_url('/'));

        $this->assertSame('https://wordplate.dev/wp-content/themes/parent-theme/assets', template_url('assets'));
        $this->assertSame('https://wordplate.dev/wp-content/themes/parent-theme/assets', template_url('/assets'));
        $this->assertSame('https://wordplate.dev/wp-content/themes/parent-theme/assets/', template_url('/assets/'));

        $this->assertSame('https://wordplate.dev/wp-content/themes/parent-theme/style.css', template_url('style.css'));
        $this->assertSame('https://wordplate.dev/wp-content/themes/parent-theme/style.css', template_url('/style.css'));
    }
}
