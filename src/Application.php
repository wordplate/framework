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
use Illuminate\Contracts\Config\Repository;

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
     * @param null $basePath
     */
    public function __construct($basePath = null)
    {
        $this->registerBaseBindings();

        if ($basePath) {
            $this->setBasePath($basePath);
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
        return $this->environmentPath ?: $this->basePath;
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
