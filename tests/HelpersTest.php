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
 * This is the helpers test class.
 *
 * @author Vincent Klaiber <hello@doubledip.se>
 */
class HelpersTest extends TestCase
{
    public function testEnv()
    {
        $this->assertSame('mcfly', env('DOTENV_DEFAULT', 'mcfly'));

        $variables = [
            'DOTENV_FALSE=false' => false,
            'DOTENV_FALSE=(false)' => false,
            'DOTENV_TRUE=true' => true,
            'DOTENV_TRUE=(true)' => true,
            'DOTENV_EMPTY=empty' => '',
            'DOTENV_EMPTY=(empty)' => '',
            'DOTENV_NULL=null' => null,
            'DOTENV_NULL=(null)' => null,
            'DOTENV_QUOTED="null"' => 'null',
            "DOTENV_QUOTED='null'" => 'null',
        ];

        foreach ($variables as $variable => $expected) {
            putenv($variable);
            $this->assertSame($expected, env(explode('=', $variable)[0]));
        }
    }

    /**
     * @runInSeparateProcess
     */
    public function testMix()
    {
        mkdir(__DIR__.'/stubs/child-theme');
        mkdir(__DIR__.'/stubs/child-theme/assets');
        file_put_contents(__DIR__.'/stubs/child-theme/assets/mix-manifest.json', '{"/1955.js": "/1955.js?id=740b8162ec"}');

        $this->assertSame('https://wordplate.dev/wp-content/themes/child-theme/assets/1955.js?id=740b8162ec', (string) mix('1955.js'));

        unlink(__DIR__.'/stubs/child-theme/assets/mix-manifest.json');
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
}
