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

use WordPlate\Application;

/**
 * This is the menus component class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Menu extends AbstractComponent
{
    /**
     * Bootstrap the component.
     *
     * @param \WordPlate\Application $app
     */
    public function bootstrap(Application $app)
    {
        $this->filter->add('screen_options_show_screen', [$this, 'hideScreenOptionsTab']);

        $this->action->add('admin_bar_menu', [$this, 'removeMenuBarItems'], 999);
        $this->action->add('admin_head', [$this, 'hideMenuItems']);
        $this->action->add('admin_head', [$this, 'removeHelpPanel']);
    }

    /**
     * Remove links from admin toolbar.
     *
     * @param $menu
     *
     * @return void
     */
    public function removeMenuBarItems($menu)
    {
        $nodes = config('menus.links');

        foreach ($nodes as $node) {
            $menu->remove_node($node);
        }
    }

    /**
     * Remove menu items depending on user role.
     *
     * @return void
     */
    public function hideMenuItems()
    {
        $elements = '#menu-';
        $separator = ', #menu-';

        if (current_user_can('manage_options')) {
            $elements .= implode($separator, config('menus.items.administrator'));
        } else {
            $elements .= implode($separator, config('menus.items.default'));
        }

        echo sprintf('<style> %s { display: none !important; } </style>', $elements);
    }

    /**
     * Remove help panel tab.
     *
     * @return void
     */
    public function removeHelpPanel()
    {
        if (!config('menus.tabs.help')) {
            $screen = get_current_screen();
            $screen->remove_help_tabs();
        }
    }

    /**
     * Remove screen options tab.
     *
     * @return void
     */
    public function hideScreenOptionsTab()
    {
        return config('menus.tabs.screen_options', true);
    }
}
