<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

function get_template_directory()
{
    return __DIR__.'/..';
}

function get_template_directory_uri()
{
    return 'https://localhost';
}
