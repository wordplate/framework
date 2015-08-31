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
 * This is the pages component class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Page extends AbstractComponent
{
    /**
     * Bootstrap the component.
     *
     * @return void
     */
    public function bootstrap()
    {
        $this->action->add('admin_init', [$this, 'register']);
    }

    /**
     * Create default pages specified in configuration.
     *
     * @return void
     */
    public function register()
    {
        $pages = config('pages.pages');

        if (!is_array($pages) || count($pages) <= 0) {
            return;
        }

        // Create the default pages.
        foreach ($pages as $page) {
            if (!isset($page['title']) || post_exists($page['title'])) {
                continue;
            }

            wp_insert_post([
                'post_title' => $page['title'],
                'post_status' => 'publish',
                'post_type' => 'page',
            ]);
        }

        foreach ($pages as $page) {
            if (!isset($page['title']) || !post_exists($page['title'])) {
                continue;
            }

            $page_id = get_page_by_title($page['title'])->ID;

            if (isset($page['template'])) {
                // Set page template.
                wp_update_post([
                    'ID' => $page_id,
                    'page_template' => $page['template'],
                ]);
            }

            if (isset($page['type']) && str_is($page['type'], 'home')) {
                update_option('show_on_front', 'page');
                update_option('page_on_front', $page_id);

                // Set home page.
                wp_update_post([
                    'ID' => $page_id,
                    'menu_order' => -1,
                ]);
            }

            if (isset($page['type']) && str_is($page['type'], 'blog')) {
                // Set blog page.
                update_option('page_for_posts', $page_id);
            }

            if (isset($page['parent'])) {
                $parent = get_page_by_title($page['parent']);

                // Set parent page.
                wp_update_post([
                    'ID' => $page_id,
                    'post_parent' => $parent->ID,
                ]);
            }
        }
    }
}
