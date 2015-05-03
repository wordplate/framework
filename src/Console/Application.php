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

use Symfony\Component\Console\Application as SymfonyApplication;
use WordPlate\Console\Commands\SaltsGenerate;

/**
 * This is the application console class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Application extends SymfonyApplication
{
    /**
     * The applications base path.
     *
     * @var string
     */
    public $basePath;

    /**
     * Create new console application instance.
     *
     * @param string $version
     * @param string $basePath
     *
     * @return void
     */
    public function __construct($version, $basePath)
    {
        parent::__construct('WordPlate Framework', $version);

        $this->basePath = $basePath;

        $this->registerCommands();
    }

    /**
     * Register the console commands.
     *
     * @return void
     */
    private function registerCommands()
    {
        $this->add(new SaltsGenerate($this));
    }
}
