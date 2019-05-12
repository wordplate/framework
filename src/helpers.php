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

use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

if (!function_exists('mix')) {
    /**
     * Get the path to a versioned Mix file.
     *
     * @param string $path
     * @param string $manifestDirectory
     *
     * @throws \Exception
     *
     * @return \Illuminate\Support\HtmlString
     */
    function mix(string $path, string $manifestDirectory = 'assets'): HtmlString
    {
        static $manifest;

        if (!Str::startsWith($path, '/')) {
            $path = "/{$path}";
        }

        if ($manifestDirectory && !Str::startsWith($manifestDirectory, '/')) {
            $manifestDirectory = "/{$manifestDirectory}";
        }

        if (!$manifest) {
            if (!file_exists($manifestPath = get_theme_file_path($manifestDirectory.'/mix-manifest.json'))) {
                throw new Exception('The Mix manifest does not exist.');
            }

            $manifest = json_decode(file_get_contents($manifestPath), true);
        }

        if (!array_key_exists($path, $manifest)) {
            throw new Exception("Unable to locate Mix file: {$path}. Please check your webpack.mix.js output paths and try again.");
        }

        return new HtmlString(get_theme_file_uri($manifestDirectory.$manifest[$path]));
    }
}
