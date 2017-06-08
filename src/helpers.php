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

use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use WordPlate\Container;

if (!function_exists('asset')) {
    /**
     * Generate a url for the current theme directory.
     *
     * @param string $path
     *
     * @return string
     */
    function asset(string $path = null): string
    {
        return sprintf('%s/%s', get_template_directory_uri(), ltrim($path, '/'));
    }
}

if (!function_exists('base_path')) {
    /**
     * Get the path to the base of the install.
     *
     * @param string $path
     *
     * @return string
     */
    function base_path(string $path = ''): string
    {
        $container = Container::getInstance();

        $path = $path ? DIRECTORY_SEPARATOR.$path : $path;

        return sprintf('%s%s', $container->getBasePath(), $path);
    }
}

if (!function_exists('mix')) {
    /**
     * Get the path to a versioned Mix file.
     *
     * @param string $path
     *
     * @throws \Exception
     *
     * @return \Illuminate\Support\HtmlString
     */
    function mix(string $path): HtmlString
    {
        static $manifest;
        static $shouldHotReload;

        if (!$manifest) {
            if (!file_exists($manifestPath = template_path('assets/mix-manifest.json'))) {
                throw new Exception('The Mix manifest does not exist.');
            }

            $manifest = json_decode(file_get_contents($manifestPath), true);
        }

        if (!Str::startsWith($path, '/')) {
            $path = "/{$path}";
        }

        if (!array_key_exists($path, $manifest)) {
            throw new Exception("Unable to locate Mix file: {$path}. Please check your webpack.mix.js output paths and try again.");
        }

        return $shouldHotReload = file_exists(template_path('assets/hot'))
            ? new HtmlString("http://localhost:8080{$manifest[$path]}")
            : new HtmlString(asset('assets'.$manifest[$path]));
    }
}

if (!function_exists('template_path')) {
    /**
     * Generate a path for the current theme directory.
     *
     * @param string $path
     *
     * @return string
     */
    function template_path(string $path = ''): string
    {
        $path = $path ? DIRECTORY_SEPARATOR.$path : $path;

        return sprintf('%s%s', get_template_directory(), $path);
    }
}
