<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\Debug;

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;

/**
 * This is the dumper class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Dumper
{
    /**
     * Dump a value with elegance.
     *
     * @param mixed $value
     *
     * @return void
     */
    public function dump($value)
    {
        if (class_exists(CliDumper::class)) {
            $dumper = 'cli' === PHP_SAPI ? new CliDumper() : new HtmlDumper();

            $dumper->dump((new VarCloner())->cloneVar($value));
        } else {
            var_dump($value);
        }
    }
}
