<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\Tests\Commands;

use WordPlate\Console\Commands\SaltsGenerate;

/**
 * This is the salts generate test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class SaltsGenerateTest extends AbstractCommandTest
{
    public function getCommandClass()
    {
        return SaltsGenerate::class;
    }
}
