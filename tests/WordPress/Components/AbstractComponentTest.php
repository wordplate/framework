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
use WordPlate\WordPress\Components\Component;

/**
 * This is the abstract component test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
abstract class AbstractComponentTest extends AbstractTestCase
{
    public function testIsFinal()
    {
        $component = new ReflectionClass($this->getComponentClass());
        $this->assertTrue($component->isFinal());
    }

    public function testComponent()
    {
        $component = new ReflectionClass($this->getComponentClass());
        $this->assertSame(Component::class, $component->getParentClass()->getName());
        $this->assertTrue($component->hasProperty('action'));
        $this->assertTrue($component->hasProperty('filter'));
    }

    abstract public function getComponentClass();
}
