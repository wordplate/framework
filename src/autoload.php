<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Register The Composer Auto Loader
 */
require __DIR__.'/../vendor/autoload.php';

/**
 * Load Framework Components.
 */
foreach (glob(__DIR__.'/modules/*.php') as $file) {
    require $file;
}
