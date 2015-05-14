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
 * This is the server component class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Server extends AbstractComponent
{
    /**
     * Bootstrap the component.
     *
     * @return void
     */
    public function bootstrap()
    {
        $this->action->add('admin_menu', [$this, 'registerView']);
    }

    /**
     * Add server information view to WordPress admin.
     *
     * @return void
     */
    public function registerView()
    {
        global $wpdb;

        $parent = 'options-general.php';
        $title = 'Server';
        $permission = 'update_core';
        $slug = 'server-settings';

        add_submenu_page($parent, $title, $title, $permission, $slug, function () use ($wpdb) {
            require __DIR__.'/../../views/server.php';
        });
    }
}
