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
