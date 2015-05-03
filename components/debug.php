<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as Whoops;

/**
 * Register the Whoops debug handler.
 */
if (config('app.debug', false)) {
    $whoops = new Whoops;
    $whoops->allowQuit(false);
    $whoops->writeToOutput(false);
    $whoops->pushHandler(new PrettyPageHandler);
    $whoops->register();
}
