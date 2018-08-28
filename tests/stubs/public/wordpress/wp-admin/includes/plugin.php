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

function get_plugins($plugin_folder = '')
{
    // Simulate mu-plugin call to get_plugins
    if (!empty($plugin_folder) && strpos($plugin_folder, '/mu-plugins/') !== false) {
        return [
            '.'.$plugin_folder.'emmett/brown.php' => [],
        ];
    }

    return [
        $plugin_root.'marty/mcfly.php' => [],
    ];
}

function get_mu_plugins()
{
    return [
        'emmett/brown.php' => [],
    ];
}
