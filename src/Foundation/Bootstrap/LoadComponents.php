<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\Foundation\Bootstrap;

use Symfony\Component\Finder\Finder;
use WordPlate\Foundation\Application;

/**
 * This is the components loader class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class LoadComponents
{
    /**
     * Load application components.
     *
     * @param \WordPlate\Foundation\Application $app
     *
     * @return void
     */
    public function __construct(Application $app)
    {
        foreach ($this->getComponentFiles($app) as $key => $path) {
            require $path;
        }
    }

    /**
     * Get all of the component files for the application.
     *
     * @param \WordPlate\Foundation\Application $app
     *
     * @return array
     */
    protected function getComponentFiles(Application $app)
    {
        $files = [];

        foreach (Finder::create()->files()->name('*.php')->in($app->getComponentsPath()) as $file) {
            $files[basename($file->getRealPath(), '.php')] = $file->getRealPath();
        }

        return $files;
    }
}
