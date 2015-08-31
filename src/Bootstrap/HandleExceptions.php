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

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as Whoops;
use WordPlate\Application;

/**
 * This is the handle exceptions class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class HandleExceptions
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
        if (config('theme.debug')) {
            $this->whoops()->register();
        }
    }

    /**
     * Get the Whoops instance.
     *
     * @return \Whoops\Run
     */
    protected function whoops()
    {
        $whoops = new Whoops();

        $whoops->pushHandler(new PrettyPageHandler());

        return $whoops;
    }
}
