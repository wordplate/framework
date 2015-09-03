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

use WordPlate\Exceptions\WordPlateException;

/**
 * This is the theme component class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
final class Theme extends Component
{
    /**
     * Bootstrap the component.
     *
     * @return void
     */
    public function register()
    {
        $this->disallowFileEdit();

        $this->action->add('switch_theme', [$this, 'switchTheme']);
    }

    /**
     * Prevent file edit from WordPress admin dashboard.
     *
     * @return void
     */
    private function disallowFileEdit()
    {
        if (!defined('DISALLOW_FILE_EDIT')) {
            define('DISALLOW_FILE_EDIT', config('theme.disallow_file_edit', true));
        }
    }

    /**
     * Delete WordPlate specific data from database.
     *
     * @throws \WordPlate\Exceptions\WordPlateException
     *
     * @return void
     */
    public function switchTheme()
    {
        if (strlen(config('theme.slug')) <= 0) {
            throw new WordPlateException('Theme slug is not defined in config/theme.php');
        }

        delete_option(config('theme.slug').'_activated');
    }
}
