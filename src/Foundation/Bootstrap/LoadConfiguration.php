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

use Illuminate\Config\Repository;
use Illuminate\Contracts\Config\Repository as RepositoryContract;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use WordPlate\Foundation\Application;

/**
 * This is the configuration loader class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class LoadConfiguration
{
    /**
     * Bootstrap the given application.
     *
     * @param \WordPlate\Foundation\Application $app
     */
    public function bootstrap(Application $app)
    {
        $items = [];

        $app->instance('config', $config = new Repository($items));

        $this->loadConfigurationFiles($app, $config);

        date_default_timezone_set($config['app.timezone']);

        mb_internal_encoding('UTF-8');
    }

    /**
     * Load the configuration items from all of the files.
     *
     * @param \WordPlate\Foundation\Application $app
     * @param \Illuminate\Contracts\Config\Repository $config
     */
    protected function loadConfigurationFiles(Application $app, RepositoryContract $config)
    {
        foreach ($this->getConfigurationFiles($app) as $key => $path) {
            $config->set($key, require $path);
        }
    }

    /**
     * Get all of the configuration files for the application.
     *
     * @param \WordPlate\Foundation\Application $app
     *
     * @return array
     */
    protected function getConfigurationFiles(Application $app)
    {
        $files = [];

        foreach (Finder::create()->files()->name('*.php')->in($app->getConfigPath()) as $file) {
            $nesting = $this->getConfigurationNesting($app, $file);

            $files[$nesting.basename($file->getRealPath(), '.php')] = $file->getRealPath();
        }

        return $files;
    }

    /**
     * Get the configuration file nesting path.
     *
     * @param \WordPlate\Foundation\Application $app
     * @param \Symfony\Component\Finder\SplFileInfo $file
     *
     * @return string
     */
    private function getConfigurationNesting(Application $app, SplFileInfo $file)
    {
        $directory = dirname($file->getRealPath());

        if ($tree = trim(str_replace($app->getConfigPath(), '', $directory), DIRECTORY_SEPARATOR)) {
            $tree = str_replace(DIRECTORY_SEPARATOR, '.', $tree).'.';
        }

        return $tree;
    }
}
