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

use Dotenv\Dotenv;
use Illuminate\Container\Container;
use Illuminate\Config\Repository;

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
        'WordPlate\Bootstrap\LoadConfiguration',
        'WordPlate\Bootstrap\HandleExceptions',
        'WordPlate\Bootstrap\RegisterComponents',
    ];

    /**
     * Initialize the application.
     *
     * @param null $basePath
     */
    public function __construct($basePath = null)
    {
        if ($basePath) {
            $this->registerBaseBindings();

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
     * Detect the application environment.
     *
     * @return void
     */
    public function detectEnvironment()
    {
        try {
            (new Dotenv($this->basePath))->load();
        } catch (InvalidArgumentException $e) {
            //
        }
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
