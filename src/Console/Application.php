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
use WordPlate\Console\Commands\ClearCommand;
use WordPlate\Console\Commands\SaltsGenerate;

/**
 * This is the application console class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Application extends SymfonyApplication
{
    /**
     * The latest version.
     *
     * @var string
     */
    protected $version = '2.3.0';

    /**
     * The applications base path.
     *
     * @var string
     */
    public $basePath;

    /**
     * Create new console application instance.
     *
     * @param string $basePath
     *
     * @return void
     */
    public function __construct($basePath)
    {
        parent::__construct('WordPlate Framework', $this->version);

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
        $this->add(new ClearCommand($this));
        $this->add(new SaltsGenerate($this));
    }
}
