<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Stringy\Stringy;
use WordPlate\Debug\Dumper;

if (!function_exists('dd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param mixed
     *
     * @return void
     */
    function dd()
    {
        array_map(function ($x) {
            (new Dumper())->dump($x);
        }, func_get_args());
        die(1);
    }
}

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable. Supports boolean, empty and null.
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    function env($key, $default = null)
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

        $stringy = new Stringy($value);

        if (strlen($value) > 1 && $stringy->startsWith('"') && $stringy->endsWith($value, '"')) {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if (!function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
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
     * @return array
     */
    function acf_location_query($param, $operator, $value)
    {
        return compact('param', 'operator', 'value');
    }
}

if (!function_exists('acf_hide_on_screen')) {
    /**
     * Create an ACF hide on screen array.
     *
     * @param array $items
     *
     * @return array
     */
    function acf_hide_on_screen($items)
    {
        $array = [];

        foreach ($items as $index => $item) {
            $array[$index] = $item;
        }

        return $array;
    }
}
