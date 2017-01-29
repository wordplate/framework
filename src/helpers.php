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

if (!function_exists('acf_hide_on_screen')) {
    /**
     * Create an ACF hide on screen array.
     *
     * @param string[] $items
     *
     * @deprecated since version 4.0
     *
     * @return array
     */
    function acf_hide_on_screen(array $items): array
    {
        $array = [];

        foreach ($items as $i => $item) {
            $array[$i] = $item;
        }

        return $array;
    }
}

if (!function_exists('acf_location_query')) {
    /**
     * Create an ACF location query array.
     *
     * @param string $param
     * @param string $operator
     * @param string $value
     *
     * @deprecated since version 4.0
     *
     * @return array
     */
    function acf_location_query(string $param, string $operator, string $value): array
    {
        return compact('param', 'operator', 'value');
    }
}

if (!function_exists('elixir')) {
    /**
     * Get the path to a versioned Elixir file.
     *
     * @param string $file
     * @param string $buildDirectory
     *
     * @throws \InvalidArgumentException
     *
     * @return string
     */
    function elixir(string $file, string $buildDirectory = 'assets/build'): string
    {
        static $manifest;
        static $manifestPath;

        if (is_null($manifest) || $manifestPath !== $buildDirectory) {
            $manifest = json_decode(file_get_contents(get_template_directory().'/'.$buildDirectory.'/rev-manifest.json'), true);
            $manifestPath = $buildDirectory;
        }

        if (isset($manifest[$file])) {
            return get_template_directory_uri().'/'.$buildDirectory.'/'.$manifest[$file];
        }

        throw new InvalidArgumentException("File {$file} not defined in asset manifest.");
    }
}

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     * Supports boolean, empty and null.
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    function env(string $key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;

            case 'false':
            case '(false)':
                return false;

            case 'empty':
            case '(empty)':
                return '';

            case 'null':
            case '(null)':
                return;
        }

        if (strlen($value) > 1 && Str::startsWith($value, '"') && Str::endsWith($value, '"')) {
            return substr($value, 1, -1);
        }

        return $value;
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
            if (!file_exists($manifestPath = get_template_directory().'/assets/mix-manifest.json')) {
                throw new Exception('The Mix manifest does not exist.');
            }

            $manifest = json_decode(file_get_contents($manifestPath), true);
        }

        if (!Str::startsWith($path, '/')) {
            $path = "/{$path}";
        }

        if (!array_key_exists($path, $manifest)) {
            throw new Exception(
                "Unable to locate Mix file: {$path}. Please check your ".
                'webpack.mix.js output paths and try again.'
            );
        }

        return $shouldHotReload = file_exists(get_template_directory().'/assets/hot')
                    ? new HtmlString("http://localhost:8080{$manifest[$path]}")
                    : new HtmlString(get_template_directory_uri().'/assets'.$manifest[$path]);
    }
}
