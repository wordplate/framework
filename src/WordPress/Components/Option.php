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
 * This is the option component.
 *
 * @author Chris Andersson <chris@puredazzle.se>
 */
final class Option extends Component
{
    /**
     * Bootstrap the component.
     *
     * @return void
     */
    public function register()
    {
        $this->action->add('admin_init', [$this, 'updatePermalink']);
    }

    /**
     * Custom footer text.
     *
     * @return string|null
     */
    public function updatePermalink()
    {
        // Force permalink structure.
        if (empty(get_option('permalink_structure'))) {
            global $wp_rewrite;
<<<<<<< HEAD:src/WordPress/Components/Options.php
            $wp_rewrite->set_permalink_structure(config('options.permalink', '/%postname%/'));
=======

            $wp_rewrite->set_permalink_structure(config('options.permalink'));
>>>>>>> 140ba23bd450f26ac1cfdf4f1a92b3865feb9be1:src/WordPress/Components/Option.php
        }
    }
}
