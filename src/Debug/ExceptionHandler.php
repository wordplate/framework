<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\Debug;

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as Whoops;
use WordPlate\Foundation\Application;

/**
 * This is the exception handler.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ExceptionHandler
{
    /**
     * The application instance.
     *
     * @var \WordPlate\Foundation\Application
     */
    private $app;

    /**
     * Create new exception handler instance.
     *
     * @param \WordPlate\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

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
