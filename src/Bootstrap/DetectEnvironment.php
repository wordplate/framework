<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\Bootstrap;

use Dotenv\Dotenv;
use InvalidArgumentException;
use WordPlate\Application;

/**
 * This is the detect environment class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class DetectEnvironment
{
    /**
     * Bootstrap the given application.
     *
     * @param \WordPlate\Application $app
     *
     * @return void
     */
    public function bootstrap(Application $app)
    {
        try {
            (new Dotenv($app->getEnvironmentPath(), $app->getEnvironmentFile()))->load();
        } catch (InvalidArgumentException $e) {
            //
        }
    }
}
