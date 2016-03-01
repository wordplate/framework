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

use Symfony\Component\VarDumper\Dumper\HtmlDumper as SymfonyDumper;
use WordPlate\Debug\HtmlDumper;
use WordPlate\Tests\AbstractTestCase;

/**
 * This is the html dumper test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class HtmlDumperTest extends AbstractTestCase
{
    public function testHtmlDumper()
    {
        $this->assertInstanceOf(SymfonyDumper::class, new HtmlDumper());
    }
}
