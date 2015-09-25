<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\Console;

use Symfony\Component\Console\Application as Console;
use WordPlate\Console\Commands\SaltsGenerate;

/**
 * This is the application console class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Application extends Console
{
    /**
     * The latest version.
     *
     * @var string
     */
    protected $version = '3.0.2';

    /**
     * The applications base path.
     *
     * @var string
     */
    protected $basePath;

    /**
     * Create new console application instance.
     *
     * @param string|null $basePath
     */
    public function __construct($basePath = null)
    {
        parent::__construct('WordPlate Framework', $this->version);

        $this->basePath = $basePath;

        $this->add(new SaltsGenerate($this));
    }

    /**
     * Get the applications base path.
     *
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }
}
