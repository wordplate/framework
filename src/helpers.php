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

        return new HtmlString(asset($manifestDirectory.$manifest[$path]));
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

if (!function_exists('template_slug')) {
    /**
     * Get page template slug.
     *
     * @param int|\WP_Post|null $post
     *
     * @return string|null
     */
    function template_slug($post = null): ?string
    {
        if (!$post) {
            return null;
        }

        $slug = get_page_template_slug($post);
        $filename = pathinfo($slug)['filename'];

        return $filename !== '' ? $filename : null;
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
