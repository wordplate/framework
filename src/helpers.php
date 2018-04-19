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
    function asset(string $path = ''): string
    {
        return stylesheet_url($path);
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

if (!function_exists('info')) {
    /**
     * Retrieves information about the current site.
     *
     * @param string $show
     * @param string $filter
     *
     * @see https://developer.wordpress.org/reference/functions/get_bloginfo
     *
     * @return string
     */
    function info(string $show = '', string $filter = 'raw'): string
    {
        return get_bloginfo($show, $filter);
    }
}

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

        if (file_exists(stylesheet_path($manifestDirectory.'/hot'))) {
            return new HtmlString("//localhost:8080{$path}");
        }

        if (!$manifest) {
            if (!file_exists($manifestPath = stylesheet_path($manifestDirectory.'/mix-manifest.json'))) {
                throw new Exception('The Mix manifest does not exist.');
            }

            $manifest = json_decode(file_get_contents($manifestPath), true);
        }

        if (!array_key_exists($path, $manifest)) {
            throw new Exception("Unable to locate Mix file: {$path}. Please check your webpack.mix.js output paths and try again.");
        }

        return new HtmlString(asset($manifestDirectory.$manifest[$path]));
    }
}

if (!function_exists('stylesheet_path')) {
    /**
     * Generate a path for the current/child theme directory.
     *
     * @param string $path
     *
     * @return string
     */
    function stylesheet_path(string $path = ''): string
    {
        $path = $path !== DIRECTORY_SEPARATOR ? ltrim($path, DIRECTORY_SEPARATOR) : $path;
        $path = $path && $path !== DIRECTORY_SEPARATOR ? '/'.$path : $path;

        return sprintf('%s%s', get_stylesheet_directory(), $path);
    }
}

if (!function_exists('stylesheet_url')) {
    /**
     * Generate a uri for the current/child theme directory.
     *
     * @param string $path
     *
     * @return string
     */
    function stylesheet_url(string $path = ''): string
    {
        $path = $path !== '/' ? ltrim($path, '/') : $path;
        $path = $path && $path !== '/' ? '/'.$path : $path;

        return sprintf('%s%s', get_stylesheet_directory_uri(), $path);
    }
}

if (!function_exists('template_path')) {
    /**
     * Generate a path for the current theme directory or to the parent theme
     * if a child theme is being used.
     *
     * @param string $path
     *
     * @return string
     */
    function template_path(string $path = ''): string
    {
        $path = $path !== DIRECTORY_SEPARATOR ? ltrim($path, DIRECTORY_SEPARATOR) : $path;
        $path = $path && $path !== DIRECTORY_SEPARATOR ? '/'.$path : $path;

        return sprintf('%s%s', get_template_directory(), $path);
    }
}

if (!function_exists('template_url')) {
    /**
     * Generate a uri for the current theme directory or to the parent theme
     * if a child theme is being used.
     *
     * @param string $path
     *
     * @return string
     */
    function template_url(string $path = ''): string
    {
        $path = $path !== '/' ? ltrim($path, '/') : $path;
        $path = $path && $path !== '/' ? '/'.$path : $path;

        return sprintf('%s%s', get_template_directory_uri(), $path);
    }
}
