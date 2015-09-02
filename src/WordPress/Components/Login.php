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
 * This is the login component class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
final class Login extends Component
{
    /**
     * Bootstrap the component.
     *
     * @return void
     */
    public function register()
    {
        $this->filter->add('login_errors', [$this, 'loginErrors']);
        $this->filter->add('login_headerurl', [$this, 'loginHeaderUrl']);

        $this->action->add('login_head', [$this, 'loginHead']);
    }

    /**
     * Custom login logo.
     *
     * @return void
     */
    public function loginHead()
    {
        $path = get_template_directory_uri().config('login.image.path');
        $width = config('login.image.width').'px';

        echo "<style> h1 a { background-image:url($path) !important; background-size: 100% auto !important; width: $width !important; } </style>";
    }

    /**
     * Custom login logo url.
     *
     * @return string
     */
    public function loginHeaderUrl()
    {
        return get_site_url();
    }

    /**
     * Add custom login error message.
     *
     * @return mixed
     */
    public function loginErrors()
    {
        return config('login.error_message');
    }
}
