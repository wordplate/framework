<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@doubledip.se>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

function get_plugins($directory = '')
{
    // Simulate mu-plugin call to get_plugins.
    if (!empty($directory) && strpos($directory, '/mu-plugins/') !== false) {
        return [
            '.' . $directory . 'emmett/brown.php' => [],
        ];
    }

    return [
        'marty/mcfly.php' => [],
    ];
}

function get_mu_plugins()
{
    return [
        'emmett/brown.php' => [],
    ];
}
