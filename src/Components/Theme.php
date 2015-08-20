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

use WordPlate\Exceptions\WordPlateException;

/**
 * This is the theme component class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Theme extends AbstractComponent
{
    /**
     * Bootstrap the component.
     *
     * @return void
     */
    public function bootstrap()
    {
        $this->enableGzip();
        $this->disallowFileEdit();

        $this->action->add('switch_theme', [$this, 'switchTheme']);
        $this->action->add('after_setup_theme', [$this, 'html5Support']);
    }

    /**
     * Enable Gzip if available.
     *
     * @return void
     */
    public function enableGzip()
    {
        if (extension_loaded('zlib') && (ini_get('output_handler') !== 'ob_gzhandler') && config('theme.gzip')) {
            $this->action->add('wp', create_function('', '@ob_end_clean();@ini_set("zlib.output_compression", 1);'));
        }
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

    /**
     * Add HTML5 tag support.
     *
     * @return void
     */
    public function html5Support()
    {
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'widgets',
        ]);
    }
}
