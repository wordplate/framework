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
 * This is the bootstrap component.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
final class Footer extends Component
{
    /**
     * Bootstrap the component.
     *
     * @return void
     */
    public function register()
    {
        $this->filter->add('admin_footer_text', [$this, 'adminFooterText']);
    }

    /**
     * Custom footer text.
     *
     * @return mixed
     */
    public function adminFooterText()
    {
        return config('footer.footer_text', 'Thank you for creating with WordPress.');
    }
}
