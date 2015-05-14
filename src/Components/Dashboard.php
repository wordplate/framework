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

/**
 * This is the dashboard component class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Dashboard extends AbstractComponent
{
    /**
     * Bootstrap the component.
     *
     * @return void
     */
    public function bootstrap()
    {
        $this->action->add('wp_dashboard_setup', [$this, 'setup']);
    }

    /**
     * Remove unwanted dashboard widgets.
     *
     * @return void
     */
    public function setup()
    {
        global $wp_meta_boxes;

        $positions = config('dashboard.widgets');

        foreach ($positions as $position => $boxes) {
            foreach ($boxes as $box) {
                unset($wp_meta_boxes['dashboard'][$position]['core'][$box]);
            }
        }
    }
}
