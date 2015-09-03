<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\WordPress\Components;

use WordPlate\WordPress\Action;
use WordPlate\WordPress\Filter;

/**
 * This is the component class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Component
{
    /**
     * WordPress action instance.
     *
     * @var \WordPlate\WordPress\Action
     */
    protected $action;

    /**
     * WordPress filter instance.
     *
     * @var \WordPlate\WordPress\Filter
     */
    protected $filter;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->action = new Action();
        $this->filter = new Filter();
    }
}
