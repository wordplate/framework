<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\Tests\WordPress\Components;

use WordPlate\WordPress\Components\Dashboard;

/**
 * This is the dashboard component test.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class DashboardTest extends AbstractComponentTest
{
    public function getComponentClass()
    {
        return Dashboard::class;
    }
}
