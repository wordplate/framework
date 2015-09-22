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

use Illuminate\Config\Repository;
use Illuminate\Container\Container;

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
     * The bootstrap classes for the application.
     *
     * @var array
     */
    protected $bootstrappers = [
        'WordPlate\Bootstrap\DetectEnvironment',
        'WordPlate\Bootstrap\LoadConfiguration',
        'WordPlate\Bootstrap\HandleExceptions',
    ];

    /**
     * The WordPress components for the application.
     *
     * @var array
     */
    protected $components = [
        'WordPlate\WordPress\Components\Dashboard',
        'WordPlate\WordPress\Components\Editor',
        'WordPlate\WordPress\Components\Footer',
        'WordPlate\WordPress\Components\Login',
        'WordPlate\WordPress\Components\Mail',
        'WordPlate\WordPress\Components\Menu',
        'WordPlate\WordPress\Components\Option',
        'WordPlate\WordPress\Components\Plugin',
        'WordPlate\WordPress\Components\Theme',
        'WordPlate\WordPress\Components\Widget',
    ];

    /**
     * The custom environment path defined by the developer.
     *
     * @var string
     */
    protected $environmentPath;

    /**
     * The environment file to load during bootstrapping.
     *
     * @var string
     */
    protected $environmentFile = '.env';

    /**
     * Initialize the application.
     *
     * @param string|null $basePath
     */
    public function __construct($basePath = null)
    {
        $this->registerBaseBindings();

        if ($basePath !== null) {
            $this->setBasePath($basePath);
        }
    }

    /**
     * Run the given array of bootstrap classes.
     *
     * @return void
     */
    public function bootstrap()
    {
        foreach ($this->bootstrappers as $bootstrapper) {
            $this->make($bootstrapper)->bootstrap($this);
        }
    }

    /**
     * Register WordPress components.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->components as $component) {
            $this->make($component)->register();
        }
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
        $this->instance(Container::class, $this);

        $this->instance('config', $this->getConfigPath());
        $this->alias(Repository::class, 'config');
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
     * Get the environment file the application is using.
     *
     * @return string
     */
    public function getEnvironmentFile()
    {
        return $this->environmentFile ?: '.env';
    }

    /**
     * Get the path to the environment file directory.
     *
     * @return string
     */
    public function getEnvironmentPath()
    {
        return $this->environmentPath ?: $this->getBasePath();
    }

    /**
     * Get the base path for the application.
     *
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
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
}
