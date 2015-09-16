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

use ReflectionClass;
use WordPlate\Tests\AbstractTestCase;

/**
 * This is the abstract command test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
abstract class AbstractCommandTest extends AbstractTestCase
{
    public function testIsFinal()
    {
        $command = new ReflectionClass($this->getCommandClass());
        $this->assertTrue($command->isFinal());
    }

    public function testProperties()
    {
        $command = new ReflectionClass($this->getCommandClass());
        $this->assertNotNull($command->getProperty('name'));
        $this->assertNotNull($command->getProperty('description'));
    }

    public function testHandler()
    {
        $command = new ReflectionClass($this->getCommandClass());
        $this->assertNotNull($command->hasMethod('handle'));
    }

    abstract public function getCommandClass();
}
