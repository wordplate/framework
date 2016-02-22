<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

add_action('wp_dashboard_setup', function() {
    global $wp_meta_boxes;

    $positions = [
        'normal' => [
            'dashboard_activity',
            'dashboard_incoming_links',
            'dashboard_plugins',
            'dashboard_recent_comments',
            'dashboard_right_now',
        ],
        'side' => [
            'dashboard_primary',
            'dashboard_quick_press',
            'dashboard_recent_drafts',
            'dashboard_secondary',
        ],
    ];

    foreach ($positions as $position => $boxes) {
        foreach ($boxes as $box) {
            unset($wp_meta_boxes['dashboard'][$position]['core'][$box]);
        }
    }
});
