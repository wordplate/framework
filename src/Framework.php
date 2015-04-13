<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate;

/**
 * This is the framework class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Framework
{
    /**
     * Initialize WordPlate framework.
     *
     * @return void
     */
    public function __construct()
    {
        $this->loadConfigHelper();
        $this->loadModules();
    }

    /**
     * Load the config helper file.
     *
     * @return void
     */
    private function loadConfigHelper()
    {
        $this->loadFilePath(__DIR__.'/helpers.php');
    }

    /**
     * Load framework dependencies.
     *
     * @return void
     */
    private function loadModules()
    {
        foreach (glob(__DIR__.'/../modules/*.php') as $file) {
            $this->loadFilePath($file);
        }
    }

    /**
     * Load file by their path.
     *
     * @param $path
     *
     * @return void
     */
    private function loadFilePath($path) {
        if (is_file($path)) {
            require $path;
        }
    }
}
