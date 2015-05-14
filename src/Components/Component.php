<?php

namespace WordPlate\Components;

use WordPlate\Foundation\Application;
use WordPlate\WordPress\Action;
use WordPlate\WordPress\Filter;

class Component
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
}
