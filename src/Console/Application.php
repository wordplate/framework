<?php

namespace WordPlate\Console;

use Symfony\Component\Console\Application as SymfonyApplication;

/**
 * This is the application console class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Application extends SymfonyApplication
{
    /**
     * @param string $version
     */
    public function __construct($version)
    {
        parent::__construct('WordPlate Framework', $version);

        $this->add(new \WordPlate\Console\Commands\SaltGenerate);
    }
}
