<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\Tests\WordPress\Components;

use ReflectionClass;
use WordPlate\Tests\AbstractTestCase;

/**
 * This is the abstract component test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
abstract class AbstractComponentTest extends AbstractTestCase
{
    public function testIsFinal()
    {
        $command = new ReflectionClass($this->getComponentClass());
        $this->assertTrue($command->isFinal());
    }

    abstract public function getComponentClass();
}
