<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\Components;

use WordPlate\Foundation\Application;
use WordPlate\WordPress\Action;
use WordPlate\WordPress\Filter;

/**
 * This is the component class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
abstract class AbstractComponent
{
    /**
     * WordPress action instance.
     *
     * @var \WordPlate\WordPress\Action
     */
    protected $action;

    /**
     * The WordPlate application.
     *
     * @var \WordPlate\Foundation\Application
     */
    private $app;

    /**
     * WordPress filter instance.
     *
     * @var \WordPlate\WordPress\Filter
     */
    protected $filter;

    /**
     * Create a new component instance.
     *
     * @param \WordPlate\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        $this->action = new Action();
        $this->filter = new Filter();
    }

    /**
     * Bootstrap the component.
     *
     * @return void
     */
    abstract public function bootstrap();
}
