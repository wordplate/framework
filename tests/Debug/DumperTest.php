<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\Tests\Debug;

use WordPlate\Debug\Dumper;
use WordPlate\Tests\AbstractTestCase;

/**
 * This is the dumper test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class DumperTest extends AbstractTestCase
{
    public function testDump()
    {
        $dumper = new Dumper();

        $this->assertEmpty($dumper->dump(null));
    }
}
