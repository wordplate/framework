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

function get_bloginfo()
{
    return 'https://martymcf.ly';
}

function get_stylesheet_directory()
{
    return __DIR__.'/stubs';
}

function get_template_directory()
{
    return __DIR__.'/stubs';
}

function get_stylesheet_directory_uri()
{
    return 'https://wordplate.dev';
}

function get_current_screen()
{
    return json_decode(json_encode(['base' => 'plugins']));
}

function current_user_can()
{
    return true;
}

function is_plugin_active()
{
    return false;
}

function do_action()
{
    //
}
