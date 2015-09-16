<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\Tests\WordPress;

use ReflectionClass;
use WordPlate\Tests\AbstractTestCase;
use WordPlate\WordPress\Action;
use WordPlate\WordPress\Filter;

/**
 * This is the WordPress test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class WordPressTest extends AbstractTestCase
{
    public function testFilter()
    {
        $filter = new ReflectionClass(new Filter());
        $this->assertTrue($filter->hasMethod('add'));
        $this->assertTrue($filter->isFinal());
    }

    public function testAction()
    {
        $action = new ReflectionClass(new Action());
        $this->assertTrue($action->hasMethod('add'));
        $this->assertTrue($action->isFinal());
    }
}
