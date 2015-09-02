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

/**
 * This is the theme component class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
final class Widget extends Component
{
    /**
     * Bootstrap the component.
     *
     * @return void
     */
    public function register()
    {
        $this->filter->add('widget_text', 'shortcode_unautop');
        $this->filter->add('widget_text', 'do_shortcode');

        $this->action->add('widgets_init', [$this, 'disableWidgets'], 1);
    }

    /**
     * Disable Default Widgets from WordPress admin.
     *
     * @return void
     */
    public function disableWidgets()
    {
        foreach (config('widgets.widgets') as $widget) {
            unregister_widget($widget);
        }
    }
}
