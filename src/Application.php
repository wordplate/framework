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

use Illuminate\Container\Container;
use WordPlate\Debug\ExceptionHandler;
use WordPlate\Foundation\Bootstrap\LoadConfiguration;

/**
 * This is the application class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Application extends Container
{
    /**
     * The base path for the WordPlate installation.
     *
     * @var string
     */
    protected $basePath;

    /**
     * Initialize the application.
     *
     * @param null $basePath
     */
    public function __construct($basePath = null)
    {
        $this->registerBaseBindings();

        if ($basePath) {
            $this->setBasePath($basePath);
        }

        $this->loadConfiguration();

        $this->registerComponents();
        $this->registerExceptionHandler();
    }

    /**
     * Register the exception handler.
     *
     * @return void
     */
    protected function registerExceptionHandler()
    {
        new ExceptionHandler($this);
    }

    /**
     * Register the basic bindings into the container.
     *
     * @return void
     */
    protected function registerBaseBindings()
    {
        static::setInstance($this);

        $this->instance('app', $this);

        $this->instance('Illuminate\Container\Container', $this);
    }

    /**
     * Get the path to the application configuration files.
     *
     * @return string
     */
    public function getConfigPath()
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'config';
    }

    /**
     * Get the path to the component files.
     *
     * @return string
     */
    public function getComponentsPath()
    {
        return __DIR__.'/../../components';
    }

    /**
     * Set the base path for the application.
     *
     * @param string $basePath
     *
     * @return $this
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;

        return $this;
    }

    /**
     * Load the configuration files.
     *
     * @return void
     */
    private function loadConfiguration()
    {
        $this->instance('config', $this->getConfigPath());

        $this->alias('Illuminate\Config\Repository', 'config');

        new LoadConfiguration($this);
    }

    /**
     * Register components.
     *
     * @return void
     */
    private function registerComponents()
    {
        $components = [
            'WordPlate\\Components\\Dashboard',
            'WordPlate\\Components\\Editor',
            'WordPlate\\Components\\Footer',
            'WordPlate\\Components\\Login',
            'WordPlate\\Components\\Mail',
            'WordPlate\\Components\\Menu',
            'WordPlate\\Components\\Page',
            'WordPlate\\Components\\Plugin',
            'WordPlate\\Components\\Theme',
            'WordPlate\\Components\\Widget',
        ];

        foreach ($components as $component) {
            $instance = new $component($this);
            $instance->bootstrap();
        }
    }
}
